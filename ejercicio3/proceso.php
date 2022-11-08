<?php
$nombre = $_REQUEST['nombre'];

if ($nombre != null){
	echo "$nombre";
}else{
	echo "Datos incorrectos, faltan parámetros";
}

?>