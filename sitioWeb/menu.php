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

<form name="formulario_devoltar" method="post" action="devoltar.php">
    <input value= "Mostar vehículos para devoltar" type="submit" name="devoltar" /><br>


</form>

<form name="formulario_configuracion" method="post" action="configuracion.php">

    <br><h2> Usuario </h2>

    <input value="Modificar conta" type="submit" name="modificar" />
</form>

</body>
</html>

<?php

//iniciamos la sesión
#session_start(); ya iniciada arriba
$user=$_SESSION["usuario"];
//hacemos la conexión con el servicio mysql
$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}
mysqli_set_charset($mysqli_link,"utf8");
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
            echo "Foto: <img src=' " . $fila['foto'] . "'> <br/>";
            echo "<br/>";

        }

    }

    if(isset($_REQUEST['aluguer'])){

        $select_query = "SELECT * FROM vehiculo_aluguer";
        $result = mysqli_query($mysqli_link, $select_query);
        $numfilas=$result->num_rows;

        echo "<form name='formulario_aluger' method='post' action='aluguer.php'>";
        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<br><b> Vehículos en aluguer</b><br>";
            echo "Modelo:" . $fila['modelo'] . "<br/>";
            echo "Cantidade:" . $fila['cantidade'] . "<br/>";
            echo "Descrición:" . $fila['descricion'] . "<br/>";
            echo "Marca:" . $fila['marca'] . "<br/>";
            echo "Prezo:" . $fila['prezo'] . "<br/>";
            echo "Foto: <img src=' " . $fila['foto'] . "'> <br/>";
            $identificador=$fila['modelo'];
            echo "
            <input type='radio' name='aluguer' value='$identificador'><br>
             ";
            echo "<br/>";
        }
        echo "<input type='submit' value='Alugar'/>
            </form> ";
    }

    if(isset($_REQUEST['devoltar'])){

        $select_query = "SELECT * FROM vehiculo_alugado where usuario = '$user'";
        $result = mysqli_query($mysqli_link, $select_query);
        $numfilas=$result->num_rows;

        echo "<form name='formulario_devoltar' method='post' action='devoltar.php'>";
        echo "<select name='alugado' >";
        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $identificador=$fila['modelo'];
            $cantidad=$fila['cantidade'];
            echo " <option value='$identificador'>$identificador Cantidad[$cantidad]</option>";
            echo "<br/>";
        }
        echo "</select>";
        echo "<input type='submit' value='Devoltar'/>
            </form> ";
    }


    mysqli_close($mysqli_link);


}

?>


