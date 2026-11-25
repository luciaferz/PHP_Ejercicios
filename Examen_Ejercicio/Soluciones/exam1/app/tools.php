<?php
// Funciones auxiliares: no acceden directamente a la BD, solo transforman datos.
/**
 *  Genera una cadena un texto de la clase -> 1: Turista, 2: Business, 3: First Class
 * @param int $num
 * @return string - Texto asociado al valor del número
 */
function verClase($num):string {
     // static conserva la tabla dentro de la función, aunque se llame varias veces.
     var_dump($num);
     echo " Pasa ".$num;
     static $tabla = [ "1" =>"Turista", "2" => "Bussines", "3"=>" First Class" ];
     return $tabla[$num];
}

function verEstado ( $plazas):string {
    // Devuelve el texto que la vista imprimirá según las plazas libres.
    if ($plazas > 10){
    return "Disponible";
    } else {
    return "Últimas plazas";
    }
}
