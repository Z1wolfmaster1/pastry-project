<?php
  if((!isset($_SESSION["loggedUser"]) || $_POST["login"] == "admin")) {
    header("Location: ./");
  }

  $class = $_POST["office"];

  require_once "src/models/".$class.".php";

  $Model = new $class();
  $user = $Model->findByPk($_POST["login"]);
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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/UserEdit/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?class=User&action=index">
        <button type="submit">Voltar</button>
</form>
    </header>
    <div id="formDiv">
      <form method="POST">
        <input class="textInput" type="text" value="<?php echo $user->getName(); ?>" placeholder=" Nome" name="name">
        <input class="textInput" type="text" value="<?php echo $user->getLogin(); ?>" name="login" required>
        <input class="textInput" type="text" placeholder="Senha" name="password">
        <div id="checkboxDiv">
          <input type="checkbox" name="is_admin" id="is_admin" <?php echo get_class($user) == "Administrator" ? "checked" : ""; ?> disabled>
          <label for="is_admin">Administrador</label>
        </div>
        <div id="buttonsDiv">
          <button type="submit" formaction="?class=User&action=update">Salvar</button>
          <button type="submit" formaction="?class=User&action=delete">Deletar</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
