<?php
  require_once "src/models/Attendance.php";
  require_once "src/models/Patient.php";

  class AttendanceController {
    public function index() {
      $attendanceModel = new Attendance();
      $attendances = $attendanceModel->findAll();

      $patients = array();

      foreach ($attendances as $attendance) {
        $patientModel = new Patient();
        $patient = $patientModel->findByPk($attendance->getPatientCpf());

        array_push($patients, $patient);
      }

      require_once "src/views/AttendanceList/index.php";
    }

    public function store() {
      $cpf = $_POST["cpf"];
      $attendanceDate = $_POST["attendance_date"];
      $attendanceTime = $_POST["attendance_time"];

      $patientModel = new Patient();
      $patientExists = $patientModel->findByPk($cpf);
      if (isset($patientExists)) {
        $attendance = new Attendance();
        $attendance->construct($cpf, $attendanceDate, $attendanceTime);
        $attendance->save();
      }

      require_once "src/views/AttendanceMenu/index.php";
    }

    public function edit() {
      $attendanceModel = new Attendance();
      $attendance = $attendanceModel->findByPk($_POST["cpf"]);

      require_once "src/views/AttendanceEdit/index.php";
    }

    public function update() {
      $cpf = $_POST["cpf"];
      $attendanceDate = $_POST["attendance_date"];
      $attendanceTime = $_POST["attendance_time"];

      $attendance = new Attendance();
      $attendance->construct(
        $cpf,
        $attendanceDate,
        $attendanceTime
      );

      $attendance->update();

      header('Location: ./?class=Attendance&action=index');
    }

    public function delete() {
      $cpf = $_POST["cpf"];

      $attendanceModel = new Attendance();
      $attendanceModel->delete($cpf);

      header('Location: ./?class=Attendance&action=index');
    }
  }
?>
