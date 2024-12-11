<?php
require 'connection.php';
session_start();
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  $stmtExistAcount = $link->prepare("SELECT username, password, name, level FROM users WHERE username = :username");
  $stmtExistAcount->bindParam(":username", $email);
  $stmtExistAcount->execute();
  $exists = $stmtExistAcount->fetchObject();

  if ($exists) {
    die("Ya existe un usuario con ese correo");
    header("Location: register.php");
    exit;
  } else {
    $stmtNewAcount = $link->prepare("INSERT INTO users(username, password, name) VALUES (:username, :password, :name)");
    $stmtNewAcount->bindParam(":username", $_POST['email']);
    //asi se crea una contraseña cifrada;
    $encryp_pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmtNewAcount->bindParam(":password", $encryp_pw);
    $stmtNewAcount->bindParam(":name", $_POST['name']);
    try {
      $stmtNewAcount->execute();
    } catch (PDOException $e) {
      die("Error " . $e->getMessage());
      http_response_code(404);
      exit;
    }
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $encryp_pw;
    header("Location: prueba1.php");
    exit;
  }
} else {
  http_response_code(404);
  exit;
}
