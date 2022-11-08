<?php
$horas = $_REQUEST['horas'];
$dias = $_REQUEST['dias'];

$salariohora=10;
$salariobruto=($horas*$dias)*$salariohora;
$rentenciones=$salariobruto*0.12;
$salarioneto=$salariobruto-$rentenciones;

echo "El salario neto será un total de $salarioneto €";


?>