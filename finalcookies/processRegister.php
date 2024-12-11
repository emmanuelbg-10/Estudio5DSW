<?php
require 'connection.php';

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  // Verificar si ya existe un usuario con el correo
  $stmtExistAcount = $link->prepare("SELECT username FROM users WHERE username = :username");
  $stmtExistAcount->bindParam(":username", $_POST['email']);
  $stmtExistAcount->execute();
  $exists = $stmtExistAcount->fetchObject();

  if ($exists) {
    http_response_code(404);
    exit;
  } else {
    // Crear un nuevo usuario
    $stmtNewAcount = $link->prepare("INSERT INTO users(username, password, name) VALUES (:username, :password, :name)");
    $stmtNewAcount->bindParam(":username", $_POST['email']);
    $encryp_pw = password_hash($_POST['password'], PASSWORD_DEFAULT); // Contraseña cifrada
    $stmtNewAcount->bindParam(":password", $encryp_pw);
    $stmtNewAcount->bindParam(":name", $_POST['name']);

    try {
      $stmtNewAcount->execute();
    } catch (PDOException $e) {
      die("Error: " . $e->getMessage());
    }

    // Establecer cookies
    setcookie("name", $_POST['name'], time() + 3600, "/"); // Cookie válida por 1 hora
    setcookie("email", $_POST['email'], time() + 3600, "/");
    setcookie("password", $encryp_pw, time() + 3600, "/");

    // Redirigir a prueba1.php
    header("Location: prueba1.php");
    exit;
  }
} else {
  // Si los datos están incompletos, mostrar un error 404
  http_response_code(404);
  exit;
}
