<?php
//cuando queremos trabajar con sesiones asi se inician
session_start();
if(isset($_POST['destroy'])){
  session_destroy();
  header("Location: StartSession.php");
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
<?php
if (isset($_SESSION['number_of_visits'])) {
  //asi vamos incrementandolas siempre
  $_SESSION['number_of_visits']++;
} else {
  //asi las creamos
  $_SESSION['number_of_visits'] = 1;
}
//Y asi las mostramos
printf("<p>%d</p>", $_SESSION['number_of_visits']);

?>
  <form action="" method="post">
    <button name="destroy">Eliminar</button>
  </form>
</body>
</html>

