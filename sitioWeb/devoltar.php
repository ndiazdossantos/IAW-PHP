<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
?>

<?php

//iniciamos la sesión
#session_start(); ya iniciada arriba
$user=$_SESSION["usuario"];
//hacemos la conexión con el servicio mysql
$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
+    printf("A conexion con MySQL fallou co erro: %s",
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

    if(isset($_REQUEST['devoltar'])) {

        $select_query = "SELECT * FROM vehiculo_alugado where usuario = '$user'";
        $result = mysqli_query($mysqli_link, $select_query);
        $numfilas = $result->num_rows;
        echo "<h2> Vehículos dipoñibles para devoltar</h2>";
        echo "<form name='formulario_devoltar' method='post' action='devoltar.php'>";
        echo "<select name='devolta' >";
        while ($fila = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $identificador = $fila['modelo'];
            $cantidad = $fila['cantidade'];
            $descricion = $fila['descricion'];
            $marca = $fila['marca'];
            $foto = $fila['foto'];
            echo " <option value='$identificador'>$identificador Cantidad[$cantidad]</option>";
            echo "<br/>";
        }
        echo "</select>";
        echo "<input type='submit' value='Devoltar [1]'/>
            </form> ";
        echo"  <button onclick=location.href='menu.php'>Volver</button>";
    }
// si temos un vehiculo alugado do mesmo modelo e cliente procedemos a actualizalo
        if(isset($_REQUEST['devolta'])) {
            $identificador=$_REQUEST['devolta'];
            $select_query = "SELECT * FROM vehiculo_alugado where usuario = '$user' and modelo='$identificador'";
            $result = mysqli_query($mysqli_link, $select_query);
            $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
            #$identificador = $fila['modelo'];
            $cantidad = $fila['cantidade'];
            $descricion = $fila['descricion'];
            $marca = $fila['marca'];
            $foto = $fila['foto'];


            if ($cantidad > 1) {
                $cantidad = $cantidad - 1;
                $update_query = "UPDATE vehiculo_alugado SET cantidade='$cantidad' where modelo='$identificador' and usuario='$user'";
                $update = mysqli_query($mysqli_link, $update_query);

                if ($update == false) {
                    echo "Erro o actualizar a cantidad de vehiculos dispoñibles para alugar";
                } else {
                    echo "<br>Actualizada flota de vehiculos alugados";
                }

                $select_query2 = "SELECT * FROM vehiculo_devolto where modelo='$identificador' and usuario='$user'";
                $resultado = mysqli_query($mysqli_link, $select_query2);
                $numfilas = $resultado->num_rows;
                $cantidad2 = 0;

                if($numfilas>0){
                    $valor2 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
                    $cantidad2 = $valor2['cantidade'];
                   # $descricion2 = $valor2['descricion'];
                   # $marca2 = $valor2['marca'];
                   # $foto2 = $valor2['foto'];
                }

//si temos un vehiculo xa devolto do mismo modelo e cliente procedemos a actualizar o total
                if ($cantidad2 > 0) {

                    $cantidad2 = $cantidad2 + 1;
                    $update_query2 = "UPDATE vehiculo_devolto SET cantidade='$cantidad2' where modelo='$identificador' and usuario='$user'";
                    $update2 = mysqli_query($mysqli_link, $update_query2);

                    if ($update2 == false) {
                        echo "Erro o actualizar a cantidad de vehiculos devoltos";
                    } else {
                        echo "<br>Vehiculo devolto actualizado correctamente";
                    }

// se non existe rexistramos este vehiculo devolto
                } else {

                    $insert_query = "INSERT INTO `vehiculo_devolto`(`modelo`, `cantidade`, `descricion`, `marca`, `foto`, `usuario`) VALUES ('$identificador','1','$descricion','$marca','$foto','$user')";
                    $insert = mysqli_query($mysqli_link, $insert_query);

                    if ($insert == false) {
                        echo "Erro ó alugar un modelo.";
                    } else {
                        echo '<br>Vehículo devolto';
                        echo "<br> Despois de devoltar o vehículo quedánche alquilados $cantidad do modelo $identificador da marca $marca";
                        header("refresh: 5; url = menu.php");
                    }


                }

            }else{

                $delete_query = "DELETE FROM vehiculo_alugado where modelo='$identificador' and usuario='$user'";
                $delete = mysqli_query($mysqli_link, $delete_query);

                if($delete == false){
                    echo "Erro ó borrar o último vehiculo alugado do rexistro";
                }else{
                    echo"<br>Último vehiculo alugado, borrado correctamente";
                    header("refresh: 5; url = menu.php");
                }

                $select_query2 = "SELECT * FROM vehiculo_devolto where modelo='$identificador' and usuario='$user'";
                $resultado = mysqli_query($mysqli_link, $select_query2);
                $valor2 = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
                $numfilas = $resultado->num_rows;
                $cantidad2=0;
                if($numfilas>0){
                    $cantidad2 = $valor2['cantidade'];
                    $descricion2 = $valor2['descricion'];
                    $marca2 = $valor2['marca'];
                    $foto2 = $valor2['foto'];
                }
//si temos un vehiculo xa devolto do mismo modelo e cliente procedemos a actualizar o total
                if ($cantidad2 > 0) {

                    $cantidad2 = $cantidad2 + 1;
                    $update_query2 = "UPDATE vehiculo_devolto SET cantidade='$cantidad2' where modelo='$identificador' and usuario='$user'";
                    $update2 = mysqli_query($mysqli_link, $update_query2);

                    if ($update2 == false) {
                        echo "Erro o actualizar a cantidad de vehiculos devoltos";
                    } else {
                        echo "<br>Vehiculo devolto actualizado correctamente";
                        header("refresh: 5; url = menu.php");
                    }

// se non existe rexistramos este vehiculo devolto
                } else {

                    $insert_query = "INSERT INTO `vehiculo_devolto`(`modelo`, `cantidade`, `descricion`, `marca`, `foto`, `usuario`) VALUES ('$identificador','1','$descricion','$marca','$foto','$user')";
                    $insert = mysqli_query($mysqli_link, $insert_query);

                    if ($insert == false) {
                        echo "Erro ó devoltar un modelo.";
                    } else {
                        echo '<br>Vehículo devolto';
                        echo "<br> Despois de devoltar o vehículo quedánche alquilados $cantidad do modelo $identificador da marca $marca";
                        header("refresh: 5; url = menu.php");
                    }


                }
            }

        }



    mysqli_close($mysqli_link);


}

?>
