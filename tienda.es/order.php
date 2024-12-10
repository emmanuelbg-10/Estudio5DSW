<?php
session_start();
if (!empty($_GET['order'])) {
  $_SESSION['order'] = $_GET['order'];
  header("Location: showProducts.php");
  exit;
} else {
  die("Parametro no encontrado");
  print("<a href='showProducts.php'>Volver</a>");
  exit;
}
