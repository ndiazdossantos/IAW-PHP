<?php
$nombre = $_REQUEST['producto'];
$peso = $_REQUEST['peso'];

if ($peso <= 10){
	echo "$nombre pesa $peso, tiene un peso deficiente.";
}elseif($peso>10 & $peso<= 20){
	echo "$nombre pesa $peso, tiene un peso normal.";
}elseif($peso>20){
	echo "$nombre pesa $peso, tiene un peso excesivo.";
}

?>