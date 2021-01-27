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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/PatientEdit/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?class=Patient&action=index">
        <button type="submit">Voltar</button>
</form>
    </header>
    <div id="formDiv">
      <form method="POST">
        <input class="textInput" type="text" value="<?php echo $patient->getName() ?>" placeholder=" Nome" name="name" required>
        <input class="textInput" type="text" value="<?php echo $patient->getCpf() ?>" name="cpf" readonly>
        <input class="textInput" type="date" value="<?php echo $patient->getBirthday() ?>" name="birthday" required>
        <select class="textInput" name="gender" required>
          <option value="Masculino" <?php echo $patient->getGender() == "Masculino" ? "selected" : "";?> >Masculino</option>
          <option value="Feminino" <?php echo $patient->getGender() == "Feminino" ? "selected" : "";?> >Feminino</option>
        </select>
        <input class="textInput" type="text" value="<?php echo $patient->getAddress() ?>" placeholder=" Endereço" name="address" required>
        <input class="textInput" type="text" value="<?php echo $patient->getSymptoms() ?>" placeholder=" Sintomas" name="symptoms" required>
        <select class="textInput" value="<?php echo $patient->getSeverity() ?>" name="severity" required>
          <option value="Baixa" <?php echo $patient->getSeverity() == "Baixa" ? "selected" : "";?> >Baixa</option>
          <option value="Media" <?php echo $patient->getSeverity() == "Media" ? "selected" : "";?> >Media</option>
          <option value="Alta" <?php echo $patient->getSeverity() == "Alta" ? "selected" : "";?> >Alta</option>
        </select>
        <input class="textInput" type="text" value="<?php echo $patient->getCompanion() ?>" placeholder=" Acompanhante" name="companion" required>
        <input class="textInput" type="date" value="<?php echo $patient->getStartDate() ?>" name="startDate" required>
        <div id="buttonsDiv">
          <button type="submit" formaction="?class=Patient&action=update">Salvar</button>
          <button type="submit" formaction="?class=Patient&action=delete">Deletar</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
