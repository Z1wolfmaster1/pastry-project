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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/AttendanceRegister/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=AttendanceMenu">
        <button>Voltar</button>
      </form>
    </header>
    <div id="formDiv">
      <form action="?class=Attendance&action=store" method="POST">
        <input class="textInput" type="text" placeholder=" CPF" name="cpf" required>
        <input class="textInput" type="date" name="attendance_date" required>
        <input class="textInput" type="time" name="attendance_time" required>
        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>
</body>

</html>
