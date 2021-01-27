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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/UserRegister/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=UserMenu">
        <button>Voltar</button>
      </form>
    </header>
    <div id="formDiv">
      <form action="?class=User&action=store" method="POST">
        <input class="textInput" type="text" placeholder=" Nome" name="name" required>
        <input class="textInput" type="text" placeholder=" Login" name="login" required>
        <input class="textInput" type="text" placeholder=" Senha" name="password" required>
        <div id="checkboxDiv">
          <input type="checkbox" name="is_admin" id="is_admin">
          <label for="is_admin">Administrador</label>
        </div>
        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>
</body>

</html>
