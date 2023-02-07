<?php
session_start();
echo "<br><div align='right'><b>Usuario:</b> ".$_SESSION["usuario"]."</div><br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modificar usuario</title>
</head>
<body>

<form name="formulario_rexistro" method="post" action="configuracion.php">
    <p text-align="center"> Contrasinal</p>
    <input type="text" name="contrasinal_novo" value="">
    <p text-align="center">Nome</p>
    <input type="text" name="nome_novo" value="">
    <p text-align="center"> Direccion</p>
    <input type="text" name="direccion_novo" value="">
    <p text-align="center">Telefono</p>
    <input type="text" name="telefono_novo" value="">
    <p text-align="center"> NIF ou DNI</p>
    <input type="text" name="nifdni_novo" value="">
    <p text-align="center"> Email</p>
    <input type="text" name="email_novo" value="">

    <input type="submit"/>

</body>
</html>


<?php

$user = $_SESSION["usuario"];

    if(isset($_REQUEST['contrasinal_novo']) && isset($_REQUEST['nome_novo']) && isset($_REQUEST['direccion_novo']) && isset($_REQUEST['telefono_novo']) && isset($_REQUEST['nifdni_novo']) && isset($_REQUEST['email_novo'])){

        $contrasinal = $_REQUEST['contrasinal_novo'];
        $nome = $_REQUEST['nome_novo'];
        $direccion = $_REQUEST['direccion_novo'];
        $telefono= $_REQUEST['telefono_novo'];
        $nifdni = $_REQUEST['nifdni_novo'];
        $email = $_REQUEST['email_novo'];

    }


    //establecemos conexion
    $mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
    if (mysqli_connect_errno())
    {
        printf("A conexion con MySQL fallou co erro: %s",
            mysqli_connect_error());
        exit;
    }
    //comprobación de si los campos de registro están vacía

    mysqli_set_charset($mysqli_link,"utf8");

    if (!empty($contrasinal)){

        echo '<br> Contrasinal actualizado';
        $update_query = "UPDATE usuario SET contrasinal='$contrasinal' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);

    if (!empty($nome)){

        echo '<br> Nome actualizado';
        $update_query = "UPDATE usuario SET nome='$nome' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);

    }

    if (!empty($direccion)){
        echo '<br> Direccion actualizada';
        $update_query = "UPDATE usuario SET direccion='$direccion' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);
    }

    if (!empty($telefono)){

        echo '<br> Telefono actualizado';
        $update_query = "UPDATE usuario SET telefono='$telefono' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);

    }

    if (!empty($nifdni)){

        echo ' <br> Nif & DNI actualizado';
        $update_query = "UPDATE usuario SET nifdni='$nifdni' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);

    }

    if (!empty($email)){

        echo '<br> Email actualizado';
        $update_query = "UPDATE usuario SET email='$email' where usuario='$user'";
        $update = mysqli_query($mysqli_link, $update_query);

    }

        mysqli_close($mysqli_link);
    }


?>
