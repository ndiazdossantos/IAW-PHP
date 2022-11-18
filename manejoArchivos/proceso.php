<?php

function escribirTresNumeros ($num1,$num2,$num3,$ruta){

    $fp=fopen("$ruta", "w+");

    fputs($fp,"$num1".PHP_EOL);
    fputs($fp,"$num2".PHP_EOL);
    fputs($fp,"$num3");
    fclose($fp);

}

function obtenerSuma ($ruta){

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

function obtenerArrNum ($ruta){

$fp=fopen("$ruta", "r");
    while(!feof($fp)){
        $linea=fgets($fp);
        $array[] = $linea;
    }

    fclose($fp);
    return $array;
}

function mostrar ($resul){

    print("<br><b>Posición => Contenido</b>");

    foreach($resul as $posicion => $contenido){

        print(" <br> $posicion => $contenido ");
    }

}

#Programa principal
$ruta="texto.txt";
escribirTresNumeros(1,7,4,$ruta);
print("<b>Suma</b> = <b>Resultado</b><br>");
$sumaTotal=obtenerSuma("$ruta");
print("  = $sumaTotal");
$resultado=obtenerArrNum($ruta);
mostrar($resultado);
