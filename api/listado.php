<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <button id="click">Mostrar Productos</button>
  <ul></ul>
  <script>
    const ul = document.querySelector('ul');
    document.getElementById('click').addEventListener('click', () => {
      let prom;
      <?php
      if (isset($_COOKIE['url'])) { ?>
        prom = fetch("<?= $_COOKIE['url'] ?>");
      <?php
      } else { ?>
        prom = fetch("processJson.php?boton=");
      <?php } ?>
      prom
        .then(response => {
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json()
        })
        .then(data => {
          console.log("Acaba la promesa");
          ul.innerHTML = "";
          if (data.error) {
            throw new Error(data.error);
          }
          data.forEach(product => addProduct(product));
        })
        .catch(error => {
          console.log("Error de conexión:", error.message);
          ul.innerHTML = "<li>Error de conexión: " + error.message + "</li>";
        });
      ul.innerHTML = "<li>Cargando...</li>"
      console.log(prom);
    });


    function addProduct(product) {
      const li = document.createElement('li');
      li.textContent = product.name + " " + product.price + "€";
      ul.append(li);

    }
  </script>
</body>

</html>