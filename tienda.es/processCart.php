<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php
  require 'connection.php';
  if (!empty($_GET['buy'])) {
    try {
      $link->beginTransaction();
      $id = $_GET['buy'];

      $stmtAmount = $link->prepare("SELECT amount FROM products WHERE id = :id");
      $stmtAmount->bindParam(":id", $id);
      $stmtAmount->execute();
      $amoun = $stmtAmount->fetchObject();

      // Verificar si el producto ya está en el carrito
      $stmtShowProductCart = $link->prepare("SELECT * FROM cart WHERE id = :id");
      $stmtShowProductCart->bindParam(':id', $id);
      $stmtShowProductCart->execute();
      if ($product = $stmtShowProductCart->fetchObject()) {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $amount = $product->amount + 1; // Incrementar la cantidad en 1 (o la cantidad deseada)
        $stmtUpdateCart = $link->prepare("UPDATE cart SET amount = :amount WHERE id = :id");
        $stmtUpdateCart->bindParam(':amount', $amount);
        $stmtUpdateCart->bindParam(':id', $id);
        $stmtUpdateCart->execute();
      } else {
        $stmtShowProduct = $link->prepare("SELECT id, name, price, amount FROM products WHERE id = :id;");
        $stmtShowProduct->bindParam(":id", $id);
        $stmtShowProduct->execute();

        if ($product = $stmtShowProduct->fetchObject()) {
          $stmtInsertCart = $link->prepare("INSERT INTO cart(id, name, price, amount) VALUES (:id, :name, :price, :amount)");
          $stmtInsertCart->bindParam(':id', $id);
          $stmtInsertCart->bindParam(':name', $product->name);
          $stmtInsertCart->bindParam(':price', $product->price);
          $amount = 1;
          $stmtInsertCart->bindParam(':amount', $amount);
          $stmtInsertCart->execute();
        } else {
          throw new Exception("No se encontro un producto con ese id");
          printf("<a href='showProducts.php'>Volver a la tabla Productos</a>");
        }
      }
      $stmtAmount = $link->prepare("UPDATE products SET products.amount = amount - :amount WHERE products.id = :id");
      $amount = 1;
      $stmtAmount->bindParam(':amount', $amount);
      $stmtAmount->bindParam(':id', $id);
      $stmtAmount->execute();
      if ($amoun->amount < 1) {
        throw new Exception("<p>No puedes comprar mas productos de lo que hay</p> <p><a href='showProducts.php'>Volver a la tabla Productos</a><a href='cart.php'>  Volver a la tabla Carrito</a></p>");
        printf("");
      }
      $link->commit();
      header("Location: cart.php");
    } catch (Exception $e) {
      $link->rollBack();
      die('Error: ' . $e->getMessage());
      printf("<p><a href='showProducts.php'>Volver a la tabla Productos</a><a href='cart.php'>  Volver a la tabla Carrito</a></p>");
    }
  }

  if (!empty($_GET['rest'])) {
    try {
      $link->beginTransaction();
      $id = $_GET['rest'];

      $stmtAmount = $link->prepare("SELECT amount FROM cart WHERE id = :id");
      $stmtAmount->bindParam(":id", $id);
      $stmtAmount->execute();
      $amoun = $stmtAmount->fetchObject();

      if ($amoun->amount === 1) {
        $stmtDeleteProductCart = $link->prepare("DELETE FROM cart WHERE id = $id");
        $stmtDeleteProductCart->execute();
      } else {
        // Si el producto ya está en el carrito, actualizar la cantidad
        $amount = 1; // Incrementar la cantidad en 1 (o la cantidad deseada)
        $stmtUpdateCart = $link->prepare("UPDATE cart SET amount = amount - :amount WHERE id = :id");
        $stmtUpdateCart->bindParam(':amount', $amount);
        $stmtUpdateCart->bindParam(':id', $id);
        $stmtUpdateCart->execute();
      }
      $stmtSetAmount = $link->prepare("UPDATE products SET products.amount = amount + :amount WHERE products.id = :id");
      $amount = 1;
      $stmtSetAmount->bindParam(':amount', $amount);
      $stmtSetAmount->bindParam(':id', $id);
      $stmtSetAmount->execute();
      $link->commit();
      header("Location: cart.php");
    } catch (Exception $e) {
      $link->rollBack();
      die('Error: ' . $e->getMessage());
      printf("<a href='showProducts.php'>Volver a la tabla Productos</a>");
    }
  }
  ?>
</body>

</html>