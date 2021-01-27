<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/styles/global.css">
  <link rel="stylesheet" href="src/views/Login/style.css">
  <title>Login</title>
</head>
<body>
  <span><?php echo isset($_SESSION["loginErrorMessage"]) ? $_SESSION["loginErrorMessage"] : "" ?></span>
  <form action="?class=Session&action=store" method="post" autocomplete="off">
    <input class="textInput" placeholder="Login" type="text" name="login" required>
    <label for="name" class="inputLabel">Login</label>
    <input class="textInput" placeholder="Senha" type="password" name="password" required>
    <label for="name" class="inputLabel" style="margin-left: -5.48rem;">Senha</label>
    <input class="submitInput" type="submit" value="Entrar">
  </form>
</body>
</html>

<?php
  $_SESSION["loginErrorMessage"] = null;
?>
