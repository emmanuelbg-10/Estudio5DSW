<?php

if (isset($_POST['destroy'])) {
  // Eliminar cookies configurándolas con tiempo de expiración pasado
  setcookie("name", "", time() - 3600, "/");
  setcookie("email", "", time() - 3600, "/");
  setcookie("password", "", time() - 3600, "/");

  header("Location: login.php");
  exit;
}

if (!empty($_COOKIE['email']) && !empty($_COOKIE['name'])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
  </head>

  <body>
    <h1>Bienvenido <?= $_COOKIE['name'] ?></h1>
    <p><a href="prueba1.php">Prueba1</a> <a href="prueba2.php">prueba2.php</a></p>
    <p>Tu correo es: <?= $_COOKIE['email'] ?></p>
    <p><a href="login.php">Login</a> > <a href="register.php">Register</a></p>

    <form action="" method="post">
      <button name="destroy">Destruir las cookies</button>
    </form>
  </body>

  </html>
<?php
} else {
  echo "Antes debes de iniciar sesión o registrarte";
  echo '<p><a href="login.php">Login</a> > <a href="register.php">Register</a></p>';
}




// htmlspecialchars($_COOKIE['email'], ENT_QUOTES, 'UTF-8')
// htmlspecialchars($_COOKIE['name'], ENT_QUOTES, 'UTF-8')

?>