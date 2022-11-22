<?php
$nome = $_REQUEST['nome'];
$apelido = $_REQUEST['apelido'];
$apelido2 = $_REQUEST['apelido2'];
$pass = $_REQUEST['contrasinal'];
$info = $_REQUEST['informacion'];

$fp=fopen("texto.txt", "w+");
fputs($fp,"O nombre do usuario é: $nome".PHP_EOL);
fputs($fp,"O primeiro apelido do usuario é: $apelido".PHP_EOL);
fputs($fp,"O segundo apelido do usuario é: $apelido2".PHP_EOL);
fputs($fp,"O contrasinal do usuario é: $pass".PHP_EOL);

if (isset($info)) {
    fputs($fp,"O usuario quere recibir información".PHP_EOL);

} else {
    fputs($fp,"O usuario non quere recibir información".PHP_EOL);
}


fclose($fp);