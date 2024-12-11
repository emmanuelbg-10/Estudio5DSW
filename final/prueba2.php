<?php
session_start();
if (isset($_POST['destroy'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

if (!empty($_SESSION)) { ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido2</title>
  </head>

  <body>
    <h1>Bienvenido <?= $_SESSION['name'] ?> 2</h1>
    <p><a href="prueba1.php">Prueba1</a> <a href="prueba2.php">prueba2.php</a> </p>
    <p>Tu contraseña es: <?= $_SESSION['password'] ?></p>
    <p><a href="login.php">Login</a> > <a href="register.php">Register</a></p>

    <form action="" method="post">
      <button name="destroy">Destruir la sesion</button>
    </form>

  </body>

  </html>
<?php
} else {
  echo "Antes debes de iniciar sesion o registrarte";
  print('<p><a href="login.php">Login</a> > <a href="register.php">Register</a></p>');
}
?>