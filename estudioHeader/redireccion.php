<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1></h1>
  <?php
  header("Location: http://www.marca.com");
  exit("Fin del script");
  // exit;

  //el header debe ir siempre al principio del html
  // porque puede dar problemas
  //el uso del header asi sirve para:
  // Redireccion del navegador asegurandonos que el codigo interior no sera ejecutado
  ?>


  <p>Hola</p>
</body>

</html>