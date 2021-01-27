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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/AttendanceList/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=AttendanceMenu">
        <button type="submit">Voltar</button>
      </form>
    </header>
    <ul>

      <ol>
        <?php
        if ($attendances != null) {
          foreach ($attendances as $index => $attendance):
        ?>
          <il onclick="document.forms['attendance<?php echo $index; ?>'].submit();">

            <form name="attendance<?php echo $index; ?>" action="?class=Attendance&action=edit" method="POST" hidden>
              <input type="text" value="<?php echo $attendance->getPatientCpf();?>" name="cpf" hidden>
            </form>

            <span>Paciente: <?php echo $patients[$index]->getName(); ?></span>
            <span>CPF: <?php echo $patients[$index]->getCpf(); ?></span>
            <span>Data de Nascimento: <?php echo date_format(date_create($patients[$index]->getBirthday()), "d/m/Y"); ?></span>
            <span>Date do atendimento: <?php echo date_format(date_create($attendance->getAttendanceDate()), "d/m/Y"); ?></span>
            <span>Hora do atendimento: <?php echo $attendance->getAttendanceTime(); ?></span>
            </input>
          </il>
        <?php
          endforeach;
        }

        else {
        ?>
        <span> <?php echo "Nenhum atendimento cadastrado!"; ?> </span>
        <?php
        }
        ?>
      </ol>
    </ul>
  </div>
</body>

</html>
