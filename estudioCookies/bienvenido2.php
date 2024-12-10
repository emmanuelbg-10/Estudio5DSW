<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <form action="" method="post">
    <?php
    if (isset($_POST['boton'])) {
      header("Location: logout.php");
    }

    if (isset($_COOKIE['login'])) {
      //este array de json lo pillas y se convierte en un array normal
      $loginData = json_decode($_COOKIE['login'], true);
      printf(" <h1>Bienvenido %s</h1>", htmlspecialchars($loginData['name']));
      printf("<p>Tu contraseña es %d</p>", $loginData['password']);
      print("<button name='boton' type='submit'>Cerrar sesion</button>");
      exit;
    } else { ?>
      <h1>Debes iniciar sesion:</h1>
      <p><a href="cookieConJson.php">Inciar sesion</a></p>
    <?php }
    ?>
  </form>
</body>

</html>