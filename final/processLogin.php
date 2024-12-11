<?php
require 'connection.php';

session_start();

if (!empty($_POST['email']) && !empty($_POST['password'])) {
  $stmtExistAcount = $link->prepare("SELECT username, password, name, level FROM users WHERE username = :username");
  $stmtExistAcount->bindParam(":username", $_POST['email']);
  $stmtExistAcount->execute();
  $exists = $stmtExistAcount->fetchObject();

  if ($exists) {
    if (password_verify($_POST['password'], $exists->password)) {
      $_SESSION['name'] = $exists->name;
      $_SESSION['email'] = $exists->username;
      $_SESSION['password'] = $exists->password;
    } else {
      http_response_code(404);
      exit;
    }
    header("Location: prueba1.php");
    exit;
  } else {
    http_response_code(404);
    exit;
  }
}
