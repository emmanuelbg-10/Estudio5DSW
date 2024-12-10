<?php
session_start();

if (isset($_POST['borrar'])) {
  session_unset();
  header("Location: login.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">


    <?php
    if (count($_SESSION['count']) > 1) {
      print("<h1>Las veces que has iniciado sesion</h1>");
      foreach ($_SESSION['count'] as $time) {
        printf("<p>%s</p>", date("Y-m-d H:i:s", $time));
      } ?>
      <button name="borrar" type="submit">Borrar tiempos</button>
    <?php
    } else { ?>
      <h1>Bienvenido <?= $_SESSION['username']  ?></h1>
    <?php }

    ?>
  </form>
</body>

</html>