<?php
  abstract class User {
    private $name;
    private $login;
    private $password;

    public function construct($name, $login, $password) {
      $this->name = $name;
      $this->login = $login;
      $this->password = $password;
    }

    public function getName() {
      return $this->name;
    }

    public function getLogin() {
      return $this->login;
    }

    public function getPassword() {
      return $this->password;
    }

    public function find($login, $password) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $class = strtolower(get_class($this))."s";

      try {
        $query = $pdo->prepare("SELECT * FROM `users` INNER JOIN $class ON users.login = $class.login WHERE users.login = :l and users.password = :p");
        $query->bindValue(":l", $login);
        $query->bindValue(":p", $password);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetch();

        if (!isset($result["login"])) {
          return null;
        }

        $user = new $this();
        $user->construct($result["name"], $result["login"], $result["password"]);

        return $user;
      } catch (Exception $e) {
        return null;
      }
    }

    public function findByPk($login) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $class = strtolower(get_class($this))."s";

      try {
        $query = $pdo->prepare("SELECT * FROM `users` INNER JOIN $class ON users.login = $class.login WHERE users.login = :l");
        $query->bindValue(":l", $login);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetch();

        if (!isset($result["login"])) {
          return null;
        }

        $user = new $this();
        $user->construct($result["name"], $result["login"], $result["password"]);

        return $user;
      } catch (Exception $e) {
        return null;
      }
    }

    public function findAll() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $class = strtolower(get_class($this))."s";

      try {
        $query = $pdo->query("SELECT * FROM `users` INNER JOIN $class ON users.login = $class.login");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        $users = array();

        foreach ($result as $fetchedUser) {
          $user = new $this();
          $user->construct($fetchedUser["name"], $fetchedUser["login"], $fetchedUser["password"]);

          array_push($users, $user);
        }

        return isset($users) ? $users : null;
      } catch (Exception $e) {
        return null;
      }
    }

    public function save() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $class = strtolower(get_class($this))."s";

      try {
        require_once "src/models/Administrator.php";

        $query = "INSERT INTO users (`name`, `login`, `password`) VALUES (?,?,?)";
        $pdo->prepare($query)->execute([
          $this->name,
          $this->login,
          $this->password
        ]);

        $query = "INSERT INTO $class (`login`) VALUES (?)";
        $pdo->prepare($query)->execute([
          $this->login,
        ]);

      } catch (Exception $e) {
        return null;
      }
    }

    public function update() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $sql = isset($this->password)
        ?
        "UPDATE `users` SET `name`=?,`password`=? WHERE login = ?"
        :
        "UPDATE `users` SET `name`=? WHERE login = ?";

      $values = isset($this->password)
        ?
        [$this->name, $this->password, $this->login]
        :
        [$this->name, $this->login];

      $pdo->prepare($sql)->execute($values);
    }

    public function delete($login) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $class = strtolower(get_class($this))."s";

      $query = $pdo->prepare("DELETE FROM `$class` WHERE login = ?");
      $success = $query->execute([$login]);

      if (!$success) {
        return $success;
      }

      $query = $pdo->prepare("DELETE FROM `users` WHERE login = ?");
      $success = $query->execute([$login]);

      return $success;
    }
  }
?>
