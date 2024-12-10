<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table {
      border-collapse: collapse;
    }

    td,
    th {
      border: 1px solid gray;
    }
  </style>
</head>

<body>
  <h1>Tabla de users</h1>
  <table>
    <thead>
      <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Name</th>
        <th>Level</th>
      </tr>
    </thead>
    <tbody>
      <?php
      require 'connection.php';
      $stmtShow = $link->prepare('SELECT username, password, name, level FROM users');

      try {
        $stmtShow->execute();
      } catch (PDOException $e) {
        echo "Error horrible " . $e->getMessage();
      }

      $users = $stmtShow->fetchAll(PDO::FETCH_OBJ);

      foreach ($users as $user) {
        echo "<tr>";
        printf("<td>%s</td> <td>%s</td> <td>%s</td> <td>%d</td>", $user->username, $user->password, $user->name, $user->level);
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>
  <p> <a href="login.php">Volver al login</a> </p>
</body>

</html>