<?php
  if(!isset($_SESSION["loggedUser"])) {
    header("Location: ./");
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Cadastro de Pacientes</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='src/styles/global.css'>
  <link rel='stylesheet' type='text/css' media='screen' href='src/styles/loggedStyle.css'>
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/AttendanceEdit/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?class=Attendance&action=index">
        <button type="submit">Voltar</button>
</form>
    </header>
    <div id="formDiv">
      <form method="POST">
        <input class="textInput" type="text" value="<?php echo $attendance->getPatientCpf() ?>" name="cpf" readonly>
        <input class="textInput" type="date" value="<?php echo $attendance->getAttendanceDate() ?>" name="attendance_date" required>
        <input class="textInput" type="time" value="<?php echo $attendance->getAttendanceTime() ?>" name="attendance_time" required>
        <div id="buttonsDiv">
          <button type="submit" formaction="?class=Attendance&action=update">Salvar</button>
          <button type="submit" formaction="?class=Attendance&action=delete">Deletar</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
