<?php
  class Attendance {
    private $patientCpf;
    private $attendanceDate;
    private $attendanceTime;

    public function construct($patientCpf, $attendanceDate, $attendanceTime) {
      $this->patientCpf = $patientCpf;
      $this->attendanceDate = $attendanceDate;
      $this->attendanceTime = $attendanceTime;
    }

    public function getPatientCpf() {
      return $this->patientCpf;
    }

    public function getAttendanceDate() {
      return $this->attendanceDate;
    }

    public function getAttendanceTime() {
      return $this->attendanceTime;
    }

    public function findAll() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      try {
        $query = $pdo->query("SELECT * FROM attendances");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $result = $query->fetchAll();

        $attendances = array();

        foreach ($result as $fetchedAttendances) {
          $attendance = new $this();
          $attendance->construct(
            $fetchedAttendances["patient_cpf"],
            $fetchedAttendances["attendance_date"],
            $fetchedAttendances["attendance_time"]
          );

          array_push($attendances, $attendance);
        }

        return isset($attendances) ? $attendances : null;
      } catch (Exception $e) {
        return null;
      }
    }

    public function findByPk($cpf) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("SELECT * FROM attendances WHERE patient_cpf = ?");
      $query->execute([$cpf]);
      $query->setFetchMode(PDO::FETCH_ASSOC);

      $result = $query->fetch();

      $attendance = new $this();
      $attendance->construct(
        $result["patient_cpf"],
        $result["attendance_date"],
        $result["attendance_time"]
      );

      return $attendance;
    }

    public function save() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = "INSERT INTO attendances (`patient_cpf`, `attendance_date`, `attendance_time`) VALUES (?,?,?)";
      $pdo->prepare($query)->execute([
        $this->patientCpf,
        $this->attendanceDate,
        $this->attendanceTime
      ]);
    }

    public function update() {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("UPDATE `attendances` SET `attendance_date`=?,`attendance_time`=? WHERE patient_cpf = ?");
      $success = $query->execute([
        $this->attendanceDate,
        $this->attendanceTime,
        $this->patientCpf
      ]);

      return $success;
    }

    public function delete($cpf) {
      require_once "src/database/connection.php";
      $connection = new Connection();
      $pdo = $connection->getConnection();

      $query = $pdo->prepare("DELETE FROM `attendances` WHERE patient_cpf = ?");
      $success = $query->execute([$cpf]);

      return $success;
    }
  }
?>
