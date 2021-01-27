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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/PatientRegister/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=PatientMenu">
        <button>Voltar</button>
      </form>
    </header>
    <div id="formDiv">
      <form action="?class=Patient&action=store" method="POST">
        <input class="textInput" type="text" placeholder=" Nome" name="name" required>
        <input class="textInput" type="text" placeholder=" CPF" name="cpf" required>
        <input class="textInput" type="date" name="birthday" required>
        <select class="textInput" name="gender" required>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
        </select>
        <input class="textInput" type="text" placeholder=" Endereço" name="address" required>
        <input class="textInput" type="text" placeholder=" Sintomas" name="symptoms" required>
        <select class="textInput" name="severity" required>
          <option value="Baixa">Baixa</option>
          <option value="Media">Media</option>
          <option value="Alta">Alta</option>
        </select>
        <input class="textInput" type="text" placeholder=" Acompanhante" name="companion" required>
        <input class="textInput" type="date" name="startDate" required>
        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>
</body>

</html>
