<?php

$ruta = $_REQUEST['ruta'];

function recorrerArray ($ruta){

    $fp=fopen("$ruta", "r");
    while(!feof($fp)){
        $linea=fgets($fp);
        $array[] = $linea;
    }

    fclose($fp);
    return $array;
}

$resultado=recorrerArray($ruta);

print("<b>Posición => Contenido</b>");

#for($i = 0; $i < count($resultado); $i++ ){

#   print("<br> $resultado[$i]");

#}

foreach($resultado as $posicion => $contenido){

    print(" <br> $posicion => $contenido ");
}