<?php if (!empty($_GET['code'])) {
  http_response_code($_GET['code']);
  exit;
} else {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>

  <body>

    <form action="" method="get">
      <button name="code" value="404"> Error 404 </button>
      <button name="code" value="200"> Todo Perfect 200</button>
    </form>
  <?php
}
  ?>
  </body>

  </html>