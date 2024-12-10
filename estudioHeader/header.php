<?php
// Vamos a mostrar un PDF
header('Content-type: application/pdf');

//creamos un pdf que lo llamaremos donwloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');
//La fuente de informacion del PDF se encuentra en original.pdf
readfile('archivos/original.pdf');


//Con esto estamos mostrando un archivo .pdf que nos descargamos, 
//le ponemos de nombre downloaded.pdf 
//pero el pdf donde cogemos la informacion es otro
