<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  if (isset($_COOKIE['login'])) {
    printf("<h1>Bienvenido %s</h1>", $_COOKIE['login']);
  } else { ?>
    <h1>Antes debes iniciar sesion: </h1>
    <p><a href="cookies.php">Incia sesion</a></p>
  <?php }

  ?>
</body>

</html>