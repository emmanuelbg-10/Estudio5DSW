<?php
require 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de cartos</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h1>Carrito de la compra</h1>
  <p><a href="showProducts.php">Tabla Productos</a> <a href="cart.php"> Tabla Carrito</a></p>

  <table>
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th colspan="2">Botones</th>
      </tr>
    </thead>
    <tbody>

      <?php

      if (isset($_SESSION['order'])) {
        $order = $_SESSION['order'];
        $stmtShowcarts = $link->prepare("SELECT id, name, price, amount FROM cart Order By $order");
      } else {
        $stmtShowcarts = $link->prepare("SELECT id, name, price, amount FROM cart");
      }

      try {
        $stmtShowcarts->execute();
      } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
      }
      $carts = $stmtShowcarts->fetchAll(PDO::FETCH_OBJ);
      $subtotal = 0;
      $total = 0;
      foreach ($carts as $cart) {
        echo "<tr>";
        $subtotal = $cart->price * $cart->amount;
        printf("
              <td>%s</td>
              <td>%.2f€</td>
              <td>%d</td>
              <td>%.2f€</td>
              <td>  
              <form action='processCart.php' method='get'>
              <button name='buy' value='%d' type='submit'>+</button>
               </form>
              </td>
              <td>  
              <form action='processCart.php' method='get'>
              <button name='rest' value='%d' type='submit'>-</button>
               </form>
              </td>
        ", $cart->name, $cart->price, $cart->amount, $subtotal, $cart->id, $cart->id);
        echo "</tr>";
        $total += $subtotal;
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="3">Total:</th>
        <?php
        printf("<th>%.2f€</th>", $total);
        ?>
      </tr>
    </tfoot>
  </table>
  <form action="deleteCart.php" method="get">
    <p> <button name="deleteAll" type="submit">Borrar Carrito</button></p>
  </form>


</body>

</html>