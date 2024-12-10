<?php

require 'connection.php';
header('Content-type: application/json; charset=utf-8');
if (isset($_GET['boton'])) {
  $stmtShowProducts = $link->prepare("SELECT id, name, price, amount FROM products");
  try {
    $stmtShowProducts->execute();
  } catch (PDOException $e) {
    echo json_encode(["error" => "Error: " . $e->getMessage()]);
    exit;
  }
  $number = "";

  $projects = $stmtShowProducts->fetchAll(PDO::FETCH_OBJ);

  if (!empty($_GET['number'])) {
    $number = $_GET['number'];
    $projects = array_filter($projects, fn($p) => $p->amount <= $number);
  }
  setcookie("url", "processJson.php?number=$number&boton=", time() + 3600, "/");
  echo json_encode(array_values($projects), JSON_PRETTY_PRINT);
} else {
  http_response_code(404);
  exit;
}
