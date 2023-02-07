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
        $valor = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $numfilas2 = $result2->num_rows;

        while ($valor = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {

            $usuario= $valor['usuario'];
            $contrasinal= $valor['contrasinal'];
            $nome=$valor['nome'];
            $direccion=$valor['direccion'];
            $telefono=$valor['telefono'];
            $nifdni=$valor['nifdni'];
            $email=$valor['email'];

            $select_query = "SELECT * FROM usuario where usuario='$usuario'";
            $resultado = mysqli_query($mysqli_link, $select_query2);
            $numfilas = $resultado->num_rows;

            if($numfilas>0){
                echo "Xa existe o usuario, imposible inserción <br>";
            }else{
                $insert_query = "INSERT INTO usuario (usuario, contrasinal, nome, direccion, telefono, nifdni, email, tipo_usuario) VALUES ('$usuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', '$email','u')";
                $insert = mysqli_query($mysqli_link, $insert_query);
                $delete_query = "DELETE FROM novo_usuario where usuario='$usuario'";
                $delete = mysqli_query($mysqli_link, $delete_query);

            }

        }
    }
    mysqli_close($mysqli_link);