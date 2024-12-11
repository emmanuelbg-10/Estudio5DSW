<?php
session_start();

if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
  header("Location: prueba1.php");
  exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>



<body>
  <h1>Inciar Sesion</h1>
  <p><a href="login.php">Login</a> > <a href="register.php">Register</a></p>
  <form action="processLogin.php" method="post">
    <label for="">Correo electrónico:</label>
    <input type="email" name="email" required><br><br>
    <label for="">Contraseña:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Enviar">
  </form>
  <p>¿No tienes una cuenta?</p>
  <p>Create una: <a href="register.php">registrarse</a></p>
</body>

</html>