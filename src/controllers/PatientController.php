<?php
  require_once "src/models/Patient.php";

  class PatientController {
    public function index() {
      $patientModel = new Patient();
      $patients = $patientModel->findAll();

      require_once "src/views/PatientList/index.php";
    }

    public function store() {
      $cpf = $_POST["cpf"];
      $name = $_POST["name"];
      $birthday = $_POST["birthday"];
      $gender = $_POST["gender"];
      $address = $_POST["address"];
      $symptoms = $_POST["symptoms"];
      $severity = $_POST["severity"];
      $companion = $_POST["companion"];
      $startDate = $_POST["startDate"];

      $patient = new Patient();
      $patient->construct(
        $cpf,
        $name,
        $birthday,
        $gender,
        $address,
        $symptoms,
        $severity,
        $companion,
        $startDate
      );

      $patient->save();

      header("Location: ./");
    }

    public function edit() {
      $userModel = new Patient();
      $patient = $userModel->findByPk($_POST["cpf"]);

      require_once "src/views/PatientEdit/index.php";
    }

    public function update() {
      $cpf = $_POST["cpf"];
      $name = $_POST["name"];
      $birthday = $_POST["birthday"];
      $gender = $_POST["gender"];
      $address = $_POST["address"];
      $symptoms = $_POST["symptoms"];
      $severity = $_POST["severity"];
      $companion = $_POST["companion"];
      $startDate = $_POST["startDate"];

      $patient = new Patient();
      $patient->construct(
        $cpf,
        $name,
        $birthday,
        $gender,
        $address,
        $symptoms,
        $severity,
        $companion,
        $startDate
      );

      $patient->update();

      header('Location: ./?class=Patient&action=index');
    }

    public function delete() {
      $cpf = $_POST["cpf"];

      $patientModel = new Patient();
      $patientModel->delete($cpf);

      header('Location: ./?class=Patient&action=index');
    }
  }
?>
