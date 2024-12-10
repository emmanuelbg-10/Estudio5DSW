<?php
require 'connection.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de productos</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Productos</h1>
  <p><a href="showProducts.php">Tabla Productos</a> <a href="cart.php"> Tabla Carrito</a></p>

  <table>
    <thead>
      <tr>
        <th><a href="order.php?order=name">Nombre</a></th>
        <th><a href="order.php?order=price">Precio</a> </th>
        <th><a href="order.php?order=amount"> Cantidad</a></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php

      if (isset($_SESSION['order'])) {
        $order = $_SESSION['order'];
        $stmtShowProducts = $link->prepare("SELECT id, name, price, amount FROM products Order By $order");
      } else {
        $stmtShowProducts = $link->prepare("SELECT id, name, price, amount FROM products");
      }

      try {
        $stmtShowProducts->execute();
      } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
      }
      $products = $stmtShowProducts->fetchAll(PDO::FETCH_OBJ);

      foreach ($products as $product) {
        echo "<tr>";
        printf("
              <td>%s</td>
              <td>%.2f€</td>
              <td>%d</td>
              <td>  
              <form action='processCart.php' method='get'>
              <button name='buy' value='%d' type='submit'>Comprar</button>
               </form>
              </td>
        ", $product->name, $product->price, $product->amount, $product->id);
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

</body>

</html>