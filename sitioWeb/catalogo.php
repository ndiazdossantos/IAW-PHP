<?php

session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];
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

        echo "<br><h2> Vehículos en venta</h2><br>";
        while ($fila = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<b>Modelo</b>:" . $fila['modelo'] . "<br/>";
            echo "<b>Cantidade</b>:" . $fila['cantidade'] . "<br/>";
            echo "<b>Descrición</b>:" . $fila['descricion'] . "<br/>";
            echo "<b>Marca</b>:" . $fila['marca'] . "<br/>";
            echo "<b>Prezo</b>:" . $fila['prezo'] . "<br/>";
            echo "<b>Foto</b>: <img src=' " . $fila['foto'] . "'> <br/>";

            echo"----------------------------------------------------<br>";
        }
        echo"<form name='formulario_volver' method='POST' action='menu.php'>
             <input type='submit' value='Volver'/>
             </form>";

    }
    if (isset($_REQUEST['aluguer'])) {

        $select_query2 = "SELECT * FROM vehiculo_aluguer";
        $result2 = mysqli_query($mysqli_link, $select_query2);
        $numfilas2 = $result2->num_rows;

        echo "<br><h2> Vehículos en aluguer</h2><br>";
        while ($fila = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<b>Modelo</b>:" . $fila['modelo'] . "<br/>";
            echo "<b>Cantidade</b>:" . $fila['cantidade'] . "<br/>";
            echo "<b>Descrición</b>:" . $fila['descricion'] . "<br/>";
            echo "<b>Marca</b>:" . $fila['marca'] . "<br/>";
            echo "<b>Prezo</b>:" . $fila['prezo'] . "<br/>";
            echo "<b>Foto</b>: <img src=' " . $fila['foto'] . "'> <br/>";

            echo "----------------------------------------------------<br>";
        }
        echo"<form name='formulario_volver' method='POST' action='menu.php'>
             <input type='submit' value='Volver'/>
             </form>";
    }

    mysqli_close($mysqli_link);


}