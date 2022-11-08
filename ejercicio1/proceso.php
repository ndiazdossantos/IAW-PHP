<?php
$numero1 = $_REQUEST['numero1'];
$numero2 = $_REQUEST['numero2'];

echo "El primer número es $numero1\n"."<br/>";
echo "El segundo número es $numero2\n"."<br/>";

$suma= $numero1 + $numero2;
$resta= $numero1 - $numero2;
$multiplicacion= $numero1 * $numero2;
$division= $numero1 / $numero2;
$modulo= $numero1 % $numero2;

echo "El resultado de la suma entre $numero1 y $numero2 es $suma\n"."<br/>";
echo "El resultado de la resta entre $numero1 y $numero2 es $resta\n"."<br/>";
echo "El resultado de la multiplicacion entre $numero1 y $numero2 es $multiplicacion\n"."<br/>";
echo "El resultado de la division entre $numero1 y $numero2 es $division\n"."<br/>";
echo "El módulo entre $numero1 y $numero2 es $modulo\n"."<br/>";

?>