<?php

$numero1 = $_REQUEST['numero1'];
$numero2 = $_REQUEST['numero2'];
$numero3 = $_REQUEST['numero3'];

$fp=fopen("datosEjercicio.txt", "w+");

fputs($fp,"$numero1\n");
fputs($fp,"$numero2\n");
fputs($fp,"$numero3\n");

fclose($fp);

?>