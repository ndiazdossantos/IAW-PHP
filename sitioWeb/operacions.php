<?php


session_start();
echo "<br><div align='right'><b>Usuario:</b> " . $_SESSION["usuario"] . "</div><br>";
$user = $_SESSION["usuario"];
//hacemos la conexión con el servicio mysql
$mysqli_link = mysqli_connect("127.0.0.1", "root", "", "frota");
if (mysqli_connect_errno()) {
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}
mysqli_set_charset($mysqli_link, "utf8");
//comprobamos si la sesión esta iniciada como usuario, si no lo está nos redirige al login, si lo está nos permite
//interactuar con el menú
if (!isset($_SESSION["usuario"])) {

    echo "No tienes la sesión iniciada, serás redireccionado para hacerlo ";
    header("refresh: 5; url = index.html");

} else {
    # si el submit es "venta" consultamos la tabla vehiculo_venda y listamos todos los vehiculos de la misma mediante un bucle while
    if (isset($_REQUEST['venta'])) {

        $select_query2 = "SELECT * FROM vehiculo_venda";
        $result2 = mysqli_query($mysqli_link, $select_query2);
        $numfilas2 = $result2->num_rows;

        echo "<br><h2> Vehículos en venta</h2><br>";
        echo "<form name='formulario_compra' method='post' action='mercar.php'>";
        while ($fila = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            echo "<b>Modelo</b>:" . $fila['modelo'] . "<br/>";
            echo "<b>Cantidade</b>:" . $fila['cantidade'] . "<br/>";
            echo "<b>Descrición</b>:" . $fila['descricion'] . "<br/>";
            echo "<b>Marca</b>:" . $fila['marca'] . "<br/>";
            echo "<b>Prezo</b>:" . $fila['prezo'] . "<br/>";
            echo "<b>Foto</b>: <img src=' " . $fila['foto'] . "'> <br/>";
            $identificador=$fila['modelo'];
            echo "
            <input type='radio' name='mercado' value='$identificador'><br>
             ";
            echo "<br/>";
            echo "----------------------------------------------------<br>";
        }
        echo "<input type='submit' value='Mercar'/>
            </form> ";
        echo"  <button onclick=location.href='menu.php'>Volver</button>";
    }
    if(isset($_REQUEST['aluguer'])){

        $select_query = "SELECT * FROM vehiculo_aluguer";
        $result = mysqli_query($mysqli_link, $select_query);
        $numfilas=$result->num_rows;

        echo "<br><h2> Vehículos en aluguer</h2><br>";
        echo "<form name='formulario_aluger' method='post' action='aluguer.php'>";
        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<b>Modelo</b>:" . $fila['modelo'] . "<br/>";
            echo "<b>Cantidade</b>:" . $fila['cantidade'] . "<br/>";
            echo "<b>Descrición</b>:" . $fila['descricion'] . "<br/>";
            echo "<b>Marca</b>:" . $fila['marca'] . "<br/>";
            echo "<b>Prezo</b>:" . $fila['prezo'] . "<br/>";
            echo "<b>Foto</b>: <img src=' " . $fila['foto'] . "'> <br/>";
            $identificador=$fila['modelo'];
            echo "
            <input type='radio' name='aluguer' value='$identificador'><br>
             ";
            echo "<br/>";
            echo "----------------------------------------------------<br>";
        }
        echo "<input type='submit' value='Alugar'/>
            </form> ";
        echo"  <button onclick=location.href='menu.php'>Volver</button>";
    }

    mysqli_close($mysqli_link);


}