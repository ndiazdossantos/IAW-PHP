<?php

session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
$user = $_SESSION["usuario"];


if(isset($_REQUEST['aluguer'])){

    $modelo=$_REQUEST['aluguer'];
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

        $select_query = "SELECT * FROM vehiculo_aluguer where modelo='$modelo'";
        $result = mysqli_query($mysqli_link, $select_query);
        $valor = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $cantidade = $valor['cantidade'];
        $modeloNovo = $valor['modelo'];
        $marca = $valor['marca'];
        $foto = $valor['foto'];
        $descricion = $valor['descricion'];

        if ($cantidade > 0) {

            $cantidade = $cantidade - 1;
            $update_query = "UPDATE vehiculo_aluguer SET cantidade='$cantidade' where modelo='$modeloNovo'";
            $update = mysqli_query($mysqli_link, $update_query);

            if($update == false){
                echo "Erro o actualizar a cantidad de vehiculos dispoñibles para alugar";
            }else{
                echo "Actualizada flota de vehículos";
            }

            $select_query2 = "SELECT * FROM vehiculo_alugado where modelo='$modeloNovo' and usuario='$user'";
            $resultado = mysqli_query($mysqli_link, $select_query2);
            $valor2= mysqli_fetch_array($resultado, MYSQLI_ASSOC);

            #si no están vaciós asigna valor
            if(isset($valor2['modelo'])&& isset($valor2['cantidade'])){
                $modeloAlugado = $valor2['modelo'];
                $cantidadeAlugado = $valor2['cantidade'];
            }

            $numfilas=$resultado->num_rows;


            # se existe un modelo alugador por "x" usuario engadimos +1 a cantidade, se non engadimos un de 0
            if ($numfilas > 0 ) {

                $cantidadeAlugado = $cantidadeAlugado + 1;
                $update_query2 = "UPDATE vehiculo_alugado SET cantidade='$cantidadeAlugado' where modelo='$modeloAlugado' and usuario='$user'";
                $update2 = mysqli_query($mysqli_link, $update_query2);

                if ($update2 == false) {
                    echo "Erro ó engadir un modelo xa alugado.";

                } else {
                    echo 'Aluguer completado';
                    echo "<br> Despois do aluguer temos $cantidade dispoñibles da marca $modelo";
                    header("refresh: 5; url = menu.php");

                }


            }else{

                $insert_query = "INSERT INTO `vehiculo_alugado`(`modelo`, `cantidade`, `descricion`, `marca`, `foto`, `usuario`) VALUES ('$modeloNovo','1','$descricion','$marca','$foto','$user')";
                $insert = mysqli_query($mysqli_link, $insert_query);

                if ($insert == false) {
                    echo "Erro ó alugar un modelo.";
                } else {
                    echo 'Aluguer completado';
                    echo "<br> Despois do aluguer temos $cantidade dispoñibles da marca $modelo";
                    header("refresh: 5; url = menu.php");

            }
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