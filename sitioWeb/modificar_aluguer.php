<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>Admin Aluguer Vehiculos</title>
</head>
<body>
  <h2>Modificar vehículos en aluguer</h2>
  <form name='formulario_vehiculo' method='post' action='administracion.php'>
    <p text-align='center'>Modelo</p>
    <input type='text' name='modelo' value=''>
    <p text-align='center'>Cantidade</p>
    <input type='text' name='cantidade' value=''>
    <p text-align='center'>Descricion</p>
    <input type='text' name='descricion' value=''>
    <p text-align='center'>Marca</p>
    <input type='text' name='marca' value=''>
    <p text-align='center'>Prezo</p>
    <input type='text' name='prezo' value=''>
    <p text-align='center'>Foto</p>
    <input type='text' name='foto' value=''>
    <input type='submit' name="modificar_aluguer"/>
  </form>
  <form name='formulario_volver' method='POST' action='menu_admin.php'>
      <input type='submit' value="Volver"/>
  </form>

</body>
</html>