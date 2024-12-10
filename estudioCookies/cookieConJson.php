<?php

if (isset($_COOKIE['login'])) {
  // Recuperar los datos de la cookie
  //$loginData = json_decode($_COOKIE['login'], true);
  header("Location: bienvenido2.php");
  // echo "Bienvenido de nuevo, " . htmlspecialchars($loginData['name']) . "!";
  exit;
}

if (!empty($_GET['name']) && !empty($_GET['password'])) {
  $loginData = [
    'name' => $_GET['name'],
    'password' => $_GET['password'] // No recomendado para producción
  ];

  // Guardar los datos en una cookie usando JSON
  setcookie('login', json_encode($loginData), time() + 3600); // Expira en 1 hora
  header("Location: bienvenido2.php");

  exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estudio de Cookies</title>
</head>

<body>
  <form action="" method="get">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" required>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Enviar</button>
  </form>
</body>

</html>