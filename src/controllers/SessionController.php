<?php
class SessionController
{
  public function store()
  {
    require_once "src/models/Administrator.php";
    require_once "src/models/Employee.php";

    $login = $_POST["login"];
    $password = md5($_POST["password"]);

    $administratorModel = new Administrator();

    $user = $administratorModel->find($login, $password);

    if ($user != NULL) {
      $_SESSION["loggedUser"] = serialize($user);

      header("Location: ./");
    }

    else {
      $employeeModel = new Employee();

      $user = $employeeModel->find($login, $password);

      if ($user != NULL) {
        $_SESSION["loggedUser"] = serialize($user);

        header("Location: ./");
      }

      else {
        $_SESSION["loginErrorMessage"] = "Usuario não encontrado";

        header("Location: ./");
      }
    }
  }

  public function destroy()
  {
    $_SESSION["loggedUser"] = null;

    header("Location: ./");
  }
}
