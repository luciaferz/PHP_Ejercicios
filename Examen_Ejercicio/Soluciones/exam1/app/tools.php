<?php 
/**
 *  Genera una cadena un texto de la clase -> 1: Turista, 2: Business, 3: First Class
 * @param int $num
 * @return string - Texto asociado al valor del número
 */
function verClase($num):string {
     var_dump($num);
     echo " Pasa ".$num;
     static $tabla = [ "1" =>"Turista", "2" => "Bussines", "3"=>" First Class" ];
     return $tabla[$num];
}

function verEstado ( $plazas):string {
    if ($plazas > 10){
    return "Disponible";
    } else {
    return "Últimas plazas";
    }
}
