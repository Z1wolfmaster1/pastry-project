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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/PatientList/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=PatientMenu">
        <button type="submit">Voltar</button>
      </form>
    </header>
    <ul>

      <ol>
        <?php
        if ($patients != null) {
          $patientIndex = 0;
          foreach ($patients as $index => $patient) {
        ?>
          <il onclick="document.forms['patient<?php echo $patientIndex; ?>'].submit();">
            <form name="patient<?php echo $patientIndex; $patientIndex++; $patientIndex++; ?>" action="?class=Patient&action=edit" method="POST" hidden>
              <input type="text" value="<?php echo $patient->getCpf();?>" name="cpf" hidden>
            </form>
            <span>Nome: <?php echo $patient->getName(); ?></span>
            <span>CPF: <?php echo $patient->getCpf(); ?></span>
            <span>Data de Nascimento: <?php echo date_format(date_create($patient->getBirthday()), "d/m/Y"); ?></span>
            <span>Gênero: <?php echo $patient->getGender(); ?></span>
            <span>Endereço: <?php echo $patient->getAddress(); ?></span>
            <span>Sintomas: <?php echo $patient->getSymptoms(); ?></span>
            <span>Gravidade: <?php echo $patient->getSeverity(); ?></span>
            <span>Acompanhante: <?php echo $patient->getCompanion(); ?></span>
            <span>Início dos sintomas: <?php echo date_format(date_create($patient->getStartDate()), "d/m/Y"); ?></span>
            </input>
          </il>
        <?php
          }
        }

        else {
        ?>
        <span> <?php echo "Nenhum paciente cadastrado!"; ?> </span>
        <?php
        }
        ?>
      </ol>
    </ul>
  </div>
</body>

</html>
