<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Admin Venta Vehiculos</title>
</head>
<body>
  <h2>Eliminar vehículos en venta</h2>
  <form name='formulario_vehiculo' method='post' action='administracion.php'>
    <p text-align='center'>Modelo</p>
    <input type='text' name='modelo' value=''>
    <p text-align='center'>Cantidade</p>
    <input type='text' name='cantidade' value=''>
    <input type='submit' name="eliminar_venta"/>
  </form>
  <br>

</body>
</html>