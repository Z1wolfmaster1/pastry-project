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
      <?php
        if (get_class(unserialize($_SESSION["loggedUser"])) == "Administrator"):
      ?>
      <input class="submitInput" type="submit" value="Funcionario" formaction="?view=UserMenu">
      <?php
        endif;
      ?>
      <input class="submitInput" type="submit" value="Atendimento" formaction="?view=AttendanceMenu">
      <input class="submitInput" type="submit" value="Pacientes" formaction="?view=PatientMenu">
    </form>
    <form id="backForm" action="?class=Session&action=destroy" method="post">
    <input class="submitInput" type="submit" value="Sair" name="action">
  </form>
</div>
</body>

</html>
