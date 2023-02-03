<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
</head>
<body>

<form name="formulario_menu" method="post" action="catalogo.php">
    <h2> Menú de interacción </h2>

    <br><input value="Mostar vehículos dispoñibles para comprar" type="submit" name="venta" /><br>
    <br><input value= "Mostar vehículos dispoñibles para alugar" type="submit" name="aluguer" /><br>
</form>


<form name="formulario_operacions" method="post" action="operacions.php">
    <input value= "Mercar vehiculo" type="submit" name="venta" /><br>
    <br>
    <input value= "Alugar vehiculo" type="submit" name="aluguer" /><br>

</form>

<form name="formulario_devoltar" method="post" action="devoltar.php">
    <input value= "Mostar vehículos para devoltar" type="submit" name="devoltar" /><br>
</form>

<form name="formulario_configuracion" method="post" action="configuracion.php">

    <br><h2> Usuario </h2>

    <input value="Modificar conta" type="submit" name="modificar" />
</form>

</body>
</html>



