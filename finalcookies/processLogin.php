<?php
require 'connection.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $stmtExistAcount = $link->prepare("SELECT username, password, name, level FROM users WHERE username = :username");
  $stmtExistAcount->bindParam(":username", $_POST['email']);
  $stmtExistAcount->execute();
  $exists = $stmtExistAcount->fetchObject();

  if ($exists) {
    if (password_verify($_POST['password'], $exists->password)) {
      // Guardar datos en cookies si el usuario seleccionó "Recordarme"

      setcookie("name", $exists->name, time() + (86400 * 30), "/"); // Cookie válida por 30 días
      setcookie("email", $exists->username, time() + (86400 * 30), "/");
      setcookie("password", $exists->password, time() + (86400 * 30), "/");

      header("Location: prueba1.php");
      exit;
    } else {
      http_response_code(404); // Contraseña incorrecta
      exit;
    }
  } else {
    http_response_code(404); // Usuario no encontrado
    exit;
  }
}
