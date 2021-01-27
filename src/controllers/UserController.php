<?php
  require_once "src/models/Administrator.php";
  require_once "src/models/Employee.php";

  class UserController {
    public function index() {
      $administratorModel = new Administrator();
      $employeeModel = new Employee();
      $users = [...$administratorModel->findAll(), ...$employeeModel->findAll()];

      require_once "src/views/UserList/index.php";
    }

    public function store() {
      $name = $_POST["name"];
      $login = $_POST["login"];
      $password = md5($_POST["password"]);
      $isAdmin = isset($_POST["is_admin"]) ? "Administrator" : "Employee";

      $user= new $isAdmin();
      $user->construct($name, $login, $password);
      $user->save();

      header("Location: ./?class=User&action=index");
    }

    public function update() {
      $name = $_POST["name"];
      $login = $_POST["login"];
      $password = $_POST["password"] != "" ? md5($_POST["password"]) : null;
      $isAdmin = isset($_POST["is_admin"]) ? "Administrator" : "Employee";

      $user= new $isAdmin();
      $user->construct($name, $login, $password);
      $user->update();

      header("Location: ./?class=User&action=index");
    }

    public function delete() {
      $login = $_POST["login"];
      $isAdmin = isset($_POST["is_admin"]) ? "Administrator" : "Employee";

      $user= new $isAdmin();
      $user->delete($login);

      header("Location: ./?class=User&action=index");
    }
  }

?>
