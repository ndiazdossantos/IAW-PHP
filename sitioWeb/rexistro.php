<?php
$usuario = $_REQUEST['usuario_novo'];
$contrasinal = $_REQUEST['contrasinal_novo'];
$nome = $_REQUEST['nome_novo'];
$direccion = $_REQUEST['direccion_novo'];
$telefono= $_REQUEST['telefono_novo'];
$nifdni = $_REQUEST['nifdni_novo'];
$email = $_REQUEST['email_novo'];

//establecemos conexion
$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}

mysqli_set_charset($mysqli_link,"utf8");
//comprobación de si los campos del formulario están vacíos, en caso de estarlo redirige nuevamente al formulario de registro
if(empty($usuario)){

    echo " <br> Campo usuario vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($contrasinal)){

    echo " <br> Campo contrasinal vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($nome)){

    echo " <br> Campo nome vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($direccion)){

    echo " <br> Campo dirección vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($telefono)){

    echo " <br> Campo telefono vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($nifdni)){

    echo " <br> Campo NIF & DNI vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

} elseif (empty($email)){

    echo " <br> Campo email vacío, debes completarlo ";
    header("refresh: 5; url = rexistro.html");

}else{

    $insert_query = "INSERT INTO novo_rexistro (usuario, contrasinal, nome, direccion, telefono, nifdni, email)
    VALUES ('$usuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', '$email')";

    if (mysqli_query($mysqli_link, $insert_query)) {
        echo 'Registro completado, regresando a la página principal';
        mysqli_close($mysqli_link);
        header("refresh: 5; url = index.html");

    }
}


?>