<?php
$usuario = $_REQUEST['usuario'];
$contrasinal = $_REQUEST['contrasinal'];

$mysqli_link = mysqli_connect("127.0.0.1", "root","", "frota");
if (mysqli_connect_errno())
{
    printf("A conexion con MySQL fallou co erro: %s",
        mysqli_connect_error());
    exit;
}
//consulta para comprobar el login indicando por parámetro usuario y contraseña, si no existe el usuario se envia al registro y si existe se le indica que la contraseña está mal
mysqli_set_charset($mysqli_link,"utf8");
$select_query = "SELECT usuario FROM usuario where usuario = '$usuario'";
$usuario_comprobado = mysqli_query($mysqli_link, $select_query);
$numfilas=$usuario_comprobado->num_rows;

//mostramos resultado positivo o negativo del login
if ($numfilas > 0) {

    $select_query = "SELECT * FROM usuario where usuario = '$usuario' and contrasinal = '$contrasinal'";
    $usuario_comprobado2 = mysqli_query($mysqli_link, $select_query);
    $numfilas2=$usuario_comprobado2->num_rows;
    $valor = mysqli_fetch_array($usuario_comprobado2, MYSQLI_ASSOC);
    #verificamos que no esté vació, si no dará error de fetch array
    if(isset($valor['tipo_usuario'])){
        $tipo_usuario=$valor['tipo_usuario'];
    }



    if ($numfilas2 > 0) {
        echo "Se ha iniciado sesión correctamente, serás redireccionado al menú.";
        session_start();
        $_SESSION["usuario"]=$_REQUEST['usuario'];
        if($tipo_usuario=="a"){
            header("refresh: 5; url = menu_admin.php");
        }else{
            header("refresh: 5; url = menu.php");
        }


    } else {
        echo "<img src='images/dancing-happy.gif' border='0' width='300' height='300'>";
        echo " <br> O contrasinal no coincide, serás redirixido en 5 segundos. ";
        header("refresh: 5; url = index.html");
    }


} else {
    echo "<img src='images/rick-and.gif' border='0' width='300' height='300'>";
    echo " <br> Non existe dicha conta, serás redirixido en 5 segundos ó rexistro. ";
    header("refresh: 5; url = rexistro.html");



}
mysqli_close($mysqli_link);


?>