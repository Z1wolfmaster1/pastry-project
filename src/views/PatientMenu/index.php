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
  <title>Main Menu</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='src/styles/global.css'>
</head>

<body>
  <div id="navForm">
    <form method="POST">
      <input class="submitInput" type="submit" value="Cadastrar Paciente" formaction="?view=PatientRegister">
      <input class="submitInput" type="submit" value="Listar Pacientes" formaction="?class=Patient&action=index">
    </form>
    <form id="backForm" action="./" method="POST">
      <input class="submitInput" type="submit" value="Voltar" name="action">
    </form>
  </div>
</body>

</html>
