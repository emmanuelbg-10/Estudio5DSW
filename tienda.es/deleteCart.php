<?php
require 'connection.php';

if (isset($_GET['deleteAll'])) {
  try {
    $link->beginTransaction();
    $stmtCart = $link->prepare("SELECT id, name, price, amount FROM cart");
    $stmtCart->execute();
    $carts = $stmtCart->fetchAll(PDO::FETCH_OBJ);
    $stmtUpdate = $link->prepare("UPDATE products SET amount= amount + :amount WHERE id = :id");
    foreach ($carts as $cart) {
      $stmtUpdate->bindParam(":id", $cart->id);
      $stmtUpdate->bindParam(":amount", $cart->amount);
      $stmtUpdate->execute();
    }


    $stmtDeleteCart = $link->prepare("DELETE FROM cart");
    $stmtDeleteCart->execute();

    $link->commit();
    header("Location: showProducts.php");
  } catch (Exception $e) {
    $link->rollBack();
    die("Error: " . $e->getMessage());
  }
}
