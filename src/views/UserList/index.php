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
  <link rel='stylesheet' type='text/css' media='screen' href='src/views/UserList/style.css'>
</head>

<body>
  <div id="container">
    <header>
      <form method="POST" action="?view=UserMenu">
        <button type="submit">Voltar</button>
      </form>
    </header>
    <ul>

      <ol>
        <?php
        if ($users != null) {
          foreach ($users as $index => $user):
        ?>
          <il onclick="<?php echo $user->getLogin() == "admin" ? "" : "document.forms['user$index'].submit();" ?>  ">
            <form name="user<?php echo $index; ?>" action="?view=UserEdit" method="POST" hidden>
              <input type="text" value="<?php echo $user->getLogin();?>" name="login" hidden>
              <input type="text" value="<?php echo get_class($user);?>" name="office" hidden>
            </form>

            <span>Nome: <?php echo $user->getName(); ?></span>
            <span>Nivel de acesso: <?php echo get_class($user) == "Administrator" ? "Administrador" : "Funcionario"; ?></span>
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
