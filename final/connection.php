<?php
$host = 'localhost';
$db = 'autendb';
$user = 'root';
$pw = '';

try {
  $link = new PDO("mysql:host=$host;dbname=$db", $user, $pw);
  $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error de conexión: " . $e->getMessage());
}
