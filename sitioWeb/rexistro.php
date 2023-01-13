<?php
$usuario = $_REQUEST['usuario_novo'];
$contrasinal = $_REQUEST['contrasinal_novo'];
$nome = $_REQUEST['nome_novo'];
$direccion = $_REQUEST['direccion_novo'];
$telefono= $_REQUEST['telefono_novo'];
$nifdni = $_REQUEST['nifdni_novo'];
$email = $_REQUEST['email_novo'];


$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}
//consulta para comprobar el login
$select_query = "SELECT usuario FROM usuario where usuario = '$usuario' and contrasinal = '$contrasinal'";
$usuario_comprobado = mysqli_query($mysqli_link, $select_query);
$numfilas=$usuario_comprobado->num_rows;

//mostramos resultado positivo o negativo del login
if ($numfilas > 0) {
    echo "hay login";
} elseif ($numfilas == 0){

    echo " <br> Non existe dicha conta, serás redirixido en 5 segundos ó rexistro. ";
    header("refresh: 5; url = rexistro.html");


} else {

    echo "<img src='images/rickpng.png' border='0' width='300' height='100'>";
    echo " <br> O contrasinal no coincide, serás redirixido en 5 segundos. ";
    header("refresh: 5; url = index.html");
}

mysqli_close($mysqli_link);


?>