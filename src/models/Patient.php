<?php
  class Patient {
    private $cpf;
    private $name;
    private $birthday;
    private $gender;
    private $address;
    private $symptoms;
    private $severity;
    private $companion;
    private $startDate;

    public function construct(
      $cpf,
      $name,
      $birthday,
      $gender,
      $address,
      $symptoms,
      $severity,
      $companion,
      $startDate
    ) {
      $this->cpf = $cpf;
      $this->name = $name;
      $this->birthday = $birthday;
      $this->gender = $gender;
      $this->address = $address;
      $this->symptoms = $symptoms;
      $this->severity = $severity;
      $this->companion = $companion;
      $this->startDate = $startDate;
    }

    public function getCpf() {
      return $this->cpf;
    }

    public function getName() {
      return $this->name;
    }

    public function getBirthday() {
      return $this->birthday;
    }

    public function getGender() {
      return $this->gender;
    }

    public function getAddress() {
      return $this->address;
    }

    public function getSymptoms() {
      return $this->symptoms;
    }

    public function getSeverity() {
      return $this->severity;
    }

    public function getCompanion() {
      return $this->companion;
    }

    public function getStartDate() {
      return $this->startDate;
    }

    public function findAll() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      try {
        $query = $pdo->query("SELECT * FROM patients");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        $patients = array();

        foreach ($result as $fetchedPatients) {
          $patient = new $this();
          $patient->construct(
            $fetchedPatients["cpf"],
            $fetchedPatients["name"],
            $fetchedPatients["birthday"],
            $fetchedPatients["gender"],
            $fetchedPatients["address"],
            $fetchedPatients["symptoms"],
            $fetchedPatients["severity"],
            $fetchedPatients["companion"],
            $fetchedPatients["startDate"]
          );

          array_push($patients, $patient);
        }

        // if ($result == true) {
        //   $this->login = $result["login"];
        //   $this->password = $result["password"];

        //   $this->isAdmin = $this->findByPk($result["id"], $pdo);

          // return $this;
        // }

        //return null;
        return isset($patients) ? $patients : null;
      } catch (Exception $e) {
        return null;
      }
    }

    public function findByPk($cpf) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("SELECT * FROM patients WHERE cpf = ?");
      $query->execute([$cpf]);
      $query->setFetchMode(PDO::FETCH_ASSOC);

      $result = $query->fetch();

      $patient = new $this();
      $patient->construct(
        $result["cpf"],
        $result["name"],
        $result["birthday"],
        $result["gender"],
        $result["address"],
        $result["symptoms"],
        $result["severity"],
        $result["companion"],
        $result["startDate"]
      );

      return $patient;
    }

    public function save() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = "INSERT INTO patients (cpf, name, birthday, gender, address, symptoms, severity, companion, startDate) VALUES (?,?,?,?,?,?,?,?,?)";
      $pdo->prepare($query)->execute([
        $this->cpf,
        $this->name,
        $this->birthday,
        $this->gender,
        $this->address,
        $this->symptoms,
        $this->severity,
        $this->companion,
        $this->startDate,
      ]);
    }

    public function update() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("UPDATE `patients` SET `name`=?,`birthday`=?,`gender`=?,`address`=?,`symptoms`=?,`severity`=?,`companion`=?,`startDate`=? WHERE cpf = ?");
      $success = $query->execute([
        $this->name,
        $this->birthday,
        $this->gender,
        $this->address,
        $this->symptoms,
        $this->severity,
        $this->companion,
        $this->startDate,
        $this->cpf,
      ]);

      return $success;
    }

    public function delete($cpf) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("DELETE FROM `patients` WHERE cpf = ?");
      $success = $query->execute([$cpf]);

      return $success;
    }
  }
?>
