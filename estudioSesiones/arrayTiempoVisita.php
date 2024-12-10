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
    //digo que aqui trabajamos con sesiones
    session_start();

    //si le diste al boton de eliminar destruyes la sesion y recargas con header para perder el post
    if (isset($_POST['delete'])) {
      session_destroy();
      header("Location: arrayTiempoVisita.php");
      exit;
    }
    //visits es un array del tiempo actual
    $_SESSION['visits'][] = time();
    echo "<h1>Historial de visitas</h1>";
    foreach ($_SESSION['visits'] as $visit) {
      //mostramos cada uno y le damos un formato para entender lo que nos devuelve
      printf("<p>%s</p>", date("Y-m-d H:i:s", $visit));
    }
    //y por ultimo mostramos con count cuantas visitas tenemos
    ?>
    <p>Numero total de visitas actualmente: <?= count($_SESSION['visits']) ?></p>
    <button name="delete" type="submit">Eliminar historial</button>
  </form>
</body>

</html>