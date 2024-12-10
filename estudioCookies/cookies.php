<?php

if (isset($_COOKIE['login'])) {
  header("Location: bienvenido.php");
  exit;
}


if (!empty($_GET['name']) && !empty($_GET['password'])) {
  $cookie_name = "login";
  $cookie_value = $_GET['name'];
  setcookie($cookie_name, $cookie_value);
  header("Location: bienvenido.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="get">
    <label for="name">Nombre</label>
    <input type="text" name="name">
    <label for="password">Contraseña:</label>
    <input type="password" name="password">
    <button type="submit">Enviar</button>

  </form>
</body>

</html>