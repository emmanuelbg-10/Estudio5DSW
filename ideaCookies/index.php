<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Checkbox y Cookies</h1>
  <form action="processForm.php" method="post">
    <label for="">Selecciona una opcion</label>
    <p>
      <input type="checkbox" name="checkbox[]" value="1">Opcion1
      <input type="checkbox" name="checkbox[]" value="2">Opcion2
      <input type="checkbox" name="checkbox[]" value="3">Opcion3
    </p>

    <input type="submit" value="enviar">
  </form>
</body>

</html>