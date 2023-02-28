<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administración</title>
    </head>
    <body>


    <form name="formulario_administracion" method="post" action="administracion.php">

        <br><h2> Admisións </h2>
        <input value="Admisións" type="submit" name="admitir" />

        <br><h2> Inventario </h2>
        <br><input value="Mostrar vehículos en venta" type="submit" name="vehiculo_venta" /><br>
        <br><input value="Mostrar vehículos en aluger" type="submit" name="vehiculo_aluger" /><br>
        <br><input value="Poñer vehiculos devoltos dispoñibles" type="submit" name="reponer_aluguer" /><br>

    </form>
      <br><h2> Funcións </h2>

    <form name='engadir_aluguer' method='POST' action='engadir_aluguer.php'>
        <input type='submit' value="Engadir vehiculo aluguer"/>
    </form>

    <form name='engadir_venta' method='POST' action='engadir_venta.php'>
        <input type='submit' value="Engadir vehiculo venta"/>
    </form>

    <form name='modificar_venta' method='POST' action='modificar_venta.php'>
        <input type='submit' value="Modificar vehiculo en venta"/>
    </form>

    <form name='modificar_aluguer' method='POST' action='modificar_aluguer.php'>
        <input type='submit' value="Modificar vehiculo en aluguer"/>
    </form>

    <form name='eliminar_aluguer' method='POST' action='eliminar_aluguer.php'>
        <input type='submit' value="Eliminar vehiculo en aluger"/>
    </form>

    <form name='eliminar_aluguer' method='POST' action='eliminar_venta.php'>
        <input type='submit' value="Eliminar vehiculo en venta"/>
    </form>

    </body>
    </html>

<?php

