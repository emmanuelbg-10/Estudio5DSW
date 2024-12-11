<?php
require 'data.php';

if (isset($_POST['checkbox'])) {
  // Recoge las opciones seleccionadas
  $selectedOptions = $_POST['checkbox'];

  // Asegúrate de que los datos sean números enteros
  $selectedOptions = array_map('intval', $selectedOptions);

  // Filtra empleados según las opciones seleccionadas
  $filteredEmployees = array_filter($employees, function ($employee) use ($selectedOptions) {
    return in_array($employee['option'], $selectedOptions);
  });

  setcookie("checkbox", serialize($filteredEmployees), time() + 3600);

  // Muestra los nombres de los empleados filtrados
  if (!empty($filteredEmployees)) {
    echo "<h2>Empleados seleccionados:</h2><ul>";
    foreach ($filteredEmployees as $employee) {
      echo "<li>" . $employee['name'] . " - " . $employee['salary'] . "€</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No hay empleados que coincidan con las opciones seleccionadas.</p>";
  }
} elseif (isset($_COOKIE['checkbox'])) {

  $cookie = unserialize($_COOKIE['checkbox']);

  if (!empty($cookie)) {
    echo "<h2>Empleados seleccionados:</h2><ul>";
    foreach ($cookie as $employee) {
      echo "<li>" . $employee['name'] . " - " . $employee['salary'] . "€</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No hay empleados que coincidan con las opciones seleccionadas.</p>";
  }
} else {
  echo "<p>No se encontro lo que pedia.</p>";
}
