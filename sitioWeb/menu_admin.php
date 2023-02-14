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
    </form>

      <br><button onclick=location.href="engadir_aluguer.php">Engadir vehiculo aluguer</button><br>
      <br><button onclick=location.href="engadir_venta.php">Engadir vehiculo venta</button><br>
      <br><button onclick=location.href="eliminar_aluguer.php">Eliminar vehiculo en aluger</button><br>
      <br><button onclick=location.href="eliminar_venta.php">Eliminar vehiculo en venta</button><br>


    </body>
    </html>

<?php

