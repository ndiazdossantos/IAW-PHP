<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];

$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");

    if (mysqli_connect_errno())
    {
        printf("A conexion con MySQL fallou co erro: %s",
            mysqli_connect_error());
        exit;
    }
    if (isset($_REQUEST['admitir'])) {

        $select_query2 = "SELECT * FROM novo_rexistro";
        $result2 = mysqli_query($mysqli_link, $select_query2);

     # iteramos por cada uno de los elementos que figuran en la tabla
        while ($valor = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

            $usuario= $valor['usuario'];
            $contrasinal= $valor['contrasinal'];
            $nome=$valor['nome'];
            $direccion=$valor['direccion'];
            $telefono=$valor['telefono'];
            $nifdni=$valor['nifdni'];
            $email=$valor['email'];

            $select_query = "SELECT * FROM usuario where usuario='$usuario'";
            $resultado = mysqli_query($mysqli_link, $select_query);
            $numfilas = $resultado->num_rows;

            # si existe un registro con dicho nombre borramos de la tabla de pendientes
            if($numfilas>0){

                echo "Xa existe o usuario, imposible inserción, eliminando usuario duplicado <b>[$usuario]</b><br>";
                $delete_query = "DELETE FROM novo_rexistro where usuario='$usuario'";
                $delete = mysqli_query($mysqli_link, $delete_query);

            # si no existe el registro eliminamos de pendientes y añadimos a usuarios
            }else{
                echo "Usuario indexado correctamente<b>[$usuario]</b><br>";
                $insert_query = "INSERT INTO usuario (usuario, contrasinal, nome, direccion, telefono, nifdni, email, tipo_usuario) VALUES ('$usuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', '$email','u')";
                $insert = mysqli_query($mysqli_link, $insert_query);
                $delete_query = "DELETE FROM novo_rexistro where usuario='$usuario'";
                $delete = mysqli_query($mysqli_link, $delete_query);

            }

        }
        echo "<br><b>Usuarios verificados, actualizada tabla de pendentes, redireccionando a panel de administracion</b><br>";
        header("refresh: 5; url = menu_admin.php");
        mysqli_close($mysqli_link);
    }

    if (isset($_REQUEST['vehiculo'])) {

                $modelo = $_REQUEST['modelo'];
                $cantidade = $_REQUEST['cantidade'];
                $descricion = $_REQUEST['descricion'];
                $marca = $_REQUEST['marca'];
                $prezo= $_REQUEST['prezo'];
                $foto = $_REQUEST['foto'];

                $select_query = "SELECT * FROM vehiculo_aluguer where modelo='$modelo'";
                $result_user = mysqli_query($mysqli_link, $select_query);
                $resultado=mysqli_fetch_array($result_user, MYSQLI_ASSOC);
                $numfilas=$result_user->num_rows;

                if(isset($resultado['cantidade'])){

                    $cantidad=$resultado['cantidade'];

                }

                if($numfilas>0){

                    $update_query = "UPDATE vehiculo_aluguer SET cantidade=cantidade+$cantidade where modelo='$modelo'";
                    $update = mysqli_query($mysqli_link, $update_query);
                    $total=$cantidade+$cantidad;
                    echo "Engadíronse <b>$cantidade</b> vehiculos do modelo <b>$modelo</b> da marca <b>$marca</b>, tes un total de <b>$total.</b> ";
                    header("refresh: 5; url = menu_admin.php");

                }else{

                    $insert_query = "INSERT INTO `vehiculo_aluguer`(`modelo`, `cantidade`, `descricion`, `marca`,`prezo`, `foto`) VALUES ('$modelo','$cantidade','$descricion','$marca',$prezo,'$foto')";
                    $insert = mysqli_query($mysqli_link, $insert_query);
                    echo "Non existían vehículos do modelo <b>$modelo</b> da marca <b>$marca</b>, engadiuse a cantidade <b>$cantidade</b> ó stock.";
                    header("refresh: 5; url = menu_admin.php");

                }
        mysqli_close($mysqli_link);


    }

    if(isset($_REQUEST['venta'])){

        $modelo = $_REQUEST['modelo'];
        $cantidade = $_REQUEST['cantidade'];
        $descricion = $_REQUEST['descricion'];
        $marca = $_REQUEST['marca'];
        $prezo= $_REQUEST['prezo'];
        $foto = $_REQUEST['foto'];

        $select_query = "SELECT * FROM vehiculo_venda where modelo='$modelo'";
        $result_user = mysqli_query($mysqli_link, $select_query);
        $resultado=mysqli_fetch_array($result_user, MYSQLI_ASSOC);
        $numfilas=$result_user->num_rows;

        if(isset($resultado['cantidade'])){

            $cantidad=$resultado['cantidade'];

        }

        if($numfilas>0){

            $update_query = "UPDATE vehiculo_venda SET cantidade=cantidade+$cantidade where modelo='$modelo'";
            $update = mysqli_query($mysqli_link, $update_query);
            $total=$cantidade+$cantidad;
            echo "Engadíronse <b>$cantidade</b> vehiculos do modelo <b>$modelo</b> da marca <b>$marca</b>, tes un total de <b>$total.</b> ";
            header("refresh: 5; url = menu_admin.php");

        }else{

            $insert_query = "INSERT INTO `vehiculo_venda`(`modelo`, `cantidade`, `descricion`, `marca`,`prezo`, `foto`) VALUES ('$modelo','$cantidade','$descricion','$marca',$prezo,'$foto')";
            $insert = mysqli_query($mysqli_link, $insert_query);
            echo "Non existían vehículos do modelo <b>$modelo</b> da marca <b>$marca</b>, engadiuse a cantidade <b>$cantidade</b> ó stock.";
            header("refresh: 5; url = menu_admin.php");

        }
        mysqli_close($mysqli_link);
    }

    if (isset($_REQUEST['eliminar_aluguer'])) {

        $modelo = $_REQUEST['modelo'];
        $cantidade = $_REQUEST['cantidade'];

        $select_query = "SELECT * FROM vehiculo_aluguer where modelo='$modelo'";
        $result_user = mysqli_query($mysqli_link, $select_query);
        $resultado=mysqli_fetch_array($result_user, MYSQLI_ASSOC);
        $numfilas=$result_user->num_rows;


        if(isset($resultado['marca'])){
            $marca=$resultado['marca'];
        }

        if(isset($resultado['cantidade'])){
            $cantidad=$resultado['cantidade'];
        }

        if($numfilas>0){

            $update_query = "UPDATE vehiculo_aluguer SET cantidade=cantidade-$cantidade where modelo='$modelo'";
            $update = mysqli_query($mysqli_link, $update_query);
            $total=$cantidad-$cantidade;
            echo "Retiráronse <b>$cantidade</b> vehiculos do modelo <b>$modelo</b> da marca <b>$marca</b>, tes un total de <b>$total.</b> ";

            $select_query = "SELECT * FROM vehiculo_aluguer where modelo='$modelo'";
            $resultado_aluguer = mysqli_query($mysqli_link, $select_query);
            $result=mysqli_fetch_array($resultado_aluguer, MYSQLI_ASSOC);

            if($result['cantidade']>0){
                header("refresh: 5; url = menu_admin.php");
            }else{
                $delete_query = "DELETE FROM vehiculo_aluguer where modelo='$modelo'";
                $delete = mysqli_query($mysqli_link, $delete_query);
                echo "<br>Como xa non quedan vehículos en stock borramos o modelo $modelo";
                header("refresh: 5; url = menu_admin.php");
            }


        }else{

            echo "Non existe stock do modelo $modelo";
            header("refresh: 5; url = menu_admin.php");
        }
        mysqli_close($mysqli_link);
    }

if (isset($_REQUEST['eliminar_venta'])) {

    $modelo = $_REQUEST['modelo'];
    $cantidade = $_REQUEST['cantidade'];

    $select_query = "SELECT * FROM vehiculo_venda where modelo='$modelo'";
    $result_user = mysqli_query($mysqli_link, $select_query);
    $resultado=mysqli_fetch_array($result_user, MYSQLI_ASSOC);
    $numfilas=$result_user->num_rows;


    if(isset($resultado['marca'])){
        $marca=$resultado['marca'];
    }

    if(isset($resultado['cantidade'])){
        $cantidad=$resultado['cantidade'];
    }

    if($numfilas>0){

        $update_query = "UPDATE vehiculo_venda SET cantidade=cantidade-$cantidade where modelo='$modelo'";
        $update = mysqli_query($mysqli_link, $update_query);
        $total=$cantidad-$cantidade;
        echo "Retiráronse <b>$cantidade</b> vehiculos do modelo <b>$modelo</b> da marca <b>$marca</b>, tes un total de <b>$total.</b> ";

        $select_query = "SELECT * FROM vehiculo_venda where modelo='$modelo'";
        $resultado_aluguer = mysqli_query($mysqli_link, $select_query);
        $result=mysqli_fetch_array($resultado_aluguer, MYSQLI_ASSOC);

        if($result['cantidade']>0){
            header("refresh: 5; url = menu_admin.php");
        }else{
            $delete_query = "DELETE FROM vehiculo_venda where modelo='$modelo'";
            $delete = mysqli_query($mysqli_link, $delete_query);
            echo "<br>Como xa non quedan vehículos en stock borramos o modelo $modelo";
            header("refresh: 5; url = menu_admin.php");
        }


    }else{

        echo "Non existe stock do modelo $modelo";
        header("refresh: 5; url = menu_admin.php");
    }
    mysqli_close($mysqli_link);
}

    if (isset($_REQUEST['vehiculo_venta'])){

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
        echo"  <button onclick=location.href='menu_admin.php'>Volver</button>";

    }
    if (isset($_REQUEST['vehiculo_aluger'])) {

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
        echo"  <button onclick=location.href='menu_admin.php'>Volver</button>";
    }

?>