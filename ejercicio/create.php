<?php
require 'connection.php';

if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['level'])) {
  try {
    $stmtCreate = $link->prepare('INSERT INTO users (username, password, name, level) VALUES (:username, :pw, :name, :level)');
    $stmtCreate->bindParam(':username', $_POST['username']);
    $encryp_pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmtCreate->bindParam(':pw', $encryp_pw);
    $stmtCreate->bindParam(':name', $_POST['name']);
    $stmtCreate->bindParam(':level', $_POST['level']);
    $stmtCreate->execute();
    header("Location: login.php");
  } catch (PDOException $e) {
    die('Error al crear el usuario: ' . $e->getMessage());
  }
} else {




?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create acount</title>
  </head>

  <body>
    <h1>Create Acount</h1>
    <form action="create.php" method="post">
      <p>
        <input type="text" name="username" placeholder="username...">
      </p>
      <p>
        <input type="password" name="password" placeholder="password...">
      </p>
      <p>
        <input type="text" name="name" placeholder="full name....">
      </p>
      <p>
        <select name="level" id="">
          <option value="1">Usuario</option>
          <option value="2">Editor</option>
          <option value="3">Administrador</option>
        </select>
      </p>
      <p>
        <input type="submit" value="Crear">
      </p>
    </form>
  </body>



  </html>
<?php
}
?>