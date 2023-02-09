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

      <br><button onclick=location.href="administracion.html">Engadir vehiculo</button><br>



    </body>
    </html>

<?php

