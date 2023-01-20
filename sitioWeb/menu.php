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

<form name="formulario_menu" method="post" action="menu.php">

    <h2> Menú de interacción </h2>


    <br><input value="Mostar vehículos dispoñibles para comprar" type="submit" name="venta" /><br>
    <br><input value= "Mostar vehículos dispoñibles para alugar" type="submit" name="aluguer" /><br>

</form>

<form name="formulario_configuracion" method="post" action="configuracion.php">

    <br><br><h2> Usuario </h2>

    <input value="Modificar conta" type="submit" name="modificar" />
</form>

</body>
</html>

<?php

//iniciamos la sesión
#session_start(); ya iniciada arriba

//hacemos la conexión con el servicio mysql
$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}
//comprobamos si la sesión esta iniciada como usuario, si no lo está nos redirige al login, si lo está nos permite
//interactuar con el menú
if(!isset($_SESSION["usuario"])){

    echo "No tienes la sesión iniciada, serás redireccionado para hacerlo ";
    header("refresh: 5; url = index.html");

}else{
    #echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>"; ya se muestra arriba
    if (isset($_REQUEST['venta'])){

        $select_query2 = "SELECT * FROM vehiculo_venda";
        $result2 = mysqli_query($mysqli_link, $select_query2);
        $numfilas2=$result2->num_rows;

        while ($fila = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<br><b> Vehículos en venta</b><br>";
            echo "Modelo:" . $fila['modelo'] . "<br/>";
            echo "Cantidade:" . $fila['cantidade'] . "<br/>";
            echo "Descrición:" . $fila['descricion'] . "<br/>";
            echo "Marca:" . $fila['marca'] . "<br/>";
            echo "Prezo:" . $fila['prezo'] . "<br/>";
            echo "Foto:" . $fila['foto'] . "<br/>";
            echo "<br/>";
        }

    }

    if(isset($_REQUEST['aluguer'])){

        $select_query = "SELECT * FROM vehiculo_aluguer";
        $result = mysqli_query($mysqli_link, $select_query);
        $numfilas=$result->num_rows;


        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<br><b> Vehículos en aluguer</b><br>";
            echo "Modelo:" . $fila['modelo'] . "<br/>";
            echo "Cantidade:" . $fila['cantidade'] . "<br/>";
            echo "Descrición:" . $fila['descricion'] . "<br/>";
            echo "Marca:" . $fila['marca'] . "<br/>";
            echo "Prezo:" . $fila['prezo'] . "<br/>";
            echo "Foto:" . $fila['foto'] . "<br/>";
            echo "<br/>";
        }
    }

    mysqli_close($mysqli_link);


}

?>