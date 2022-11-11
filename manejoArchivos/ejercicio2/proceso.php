<?php

function suma ($ruta){

    $fp=fopen("$ruta", "r");
    $sumar=0;
    while(!feof($fp)){
        $linea=fgets($fp);
        print($linea);
        $sumar += $linea;

    }

    fclose($fp);

    return $sumar;
}

$sumaTotal=suma("datosEjercicio.txt");
print(" \n = $sumaTotal");

?>