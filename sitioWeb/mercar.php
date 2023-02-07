<?php

session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];


if(isset($_REQUEST['mercado'])){

    $modelo=$_REQUEST['mercado'];
} else{

    echo "<img src='images/what-vladimir-putin.gif' border='0' width='300' height='300'>";
    echo " <br> Non seleccionaches ningún vehículo, non che gustan? Para que premes entón, dalle outra volta. <br> Xa estás de camiño ó menú. ";
    header("refresh: 5; url = menu.php");

}


//establecemos conexion
$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}

if(!isset($_SESSION["usuario"])){

    echo "No tienes la sesión iniciada, serás redireccionado para hacerlo ";
    header("refresh: 5; url = index.html");

}else {

    if (isset($modelo)) {

        $select_query = "SELECT * FROM vehiculo_venda where modelo='$modelo'";
        $result = mysqli_query($mysqli_link, $select_query);
        $valor = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $cantidade = $valor['cantidade'];
        $modeloNovo = $valor['modelo'];
        $marca = $valor['marca'];
        $foto = $valor['foto'];
        $descricion = $valor['descricion'];
        $prezo = $valor['prezo'];
        if ($cantidade > 0) {

            $cantidade = $cantidade - 1;
            $update_query = "UPDATE vehiculo_venda SET cantidade='$cantidade' where modelo='$modeloNovo'";
            $update = mysqli_query($mysqli_link, $update_query);

            if($update == false){
                echo "Erro o actualizar a cantidad de vehiculos en venta";
            }else{
                echo " <br> Quédannos $cantidade $modelo de $marca dispoñibles, todo grazas ó proletariado. ";
                header("refresh: 5; url = menu.php");

                ## creación del recibo consultando también la información del comprador, ya que la del vehiculo la tenemos.s
                $select_query = "SELECT * FROM usuario where usuario='$user'";
                $result_user = mysqli_query($mysqli_link, $select_query);
                $valor_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);

                $nome=$valor_user['nome'];
                $direccion_user=$valor_user['direccion'];
                $telefono_user=$valor_user['telefono'];
                $nif_user=$valor_user['nifdni'];
                $email_user=$valor_user['email'];

                $data_server = date('y-m-d-H-i');
                $data_recibo =date('y-m-d');
                $arquivo = "$user"."_$data_server.txt";
                $recibo = fopen("$arquivo", "w") ;
                fputs($recibo,"RECIBO DA CONTA DO USUARIO $user O $data_recibo\n\n");
                fputs($recibo,"DATOS COMPRADOR:\nNome: $nome\n NIF: $nif_user\nTelefono: $telefono_user\nEmail: $email_user\n\n");
                fputs($recibo,"DATOS VEHÍCULO:\nMarca: $marca\n Modelo: $modelo\nPrezo: $prezo\nDescrición: $descricion\n");
                fclose($recibo);

            }

        }else{

            echo "<img src='images/dancing-vladimir-putin.gif' border='0' width='300' height='300'>";
            echo " <br> Non nos quedan $modelo de $marca dipoñibles, todo é culpa de Rusia. ";
            header("refresh: 5; url = menu.php");


        }
    }


}

mysqli_set_charset($mysqli_link,"utf8");

mysqli_close($mysqli_link);



?>
