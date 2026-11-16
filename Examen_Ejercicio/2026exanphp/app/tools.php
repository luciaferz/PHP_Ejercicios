<?php 
/**
 *  Genera una cadena un texto de la clase -> 1: Turista, 2: Business, 3: First Class
 * @param int $num
 * @return string - Texto asociado al valor del número
 */
function verClase(int $num):string {
     $clase = [
        1 => "Turista",   
        2 => "Business",
        3 => "First Class"
     ];  
    
         return $clase[$num] ?? "Clase desconocida"; // ?? devulve una valor alternativo si una variable o índice no existe o es null. 
    };

/**
 *  Muestra un mensaje según el valor de plazas, si es menor de 10  devuelve 
 *  la cadena 'Ultimas plazas' y es caso contrario 'Disponibles'
 * @param int $plazas
 * @return string
 */
function verEstado (int $plazas):string {

    return $plazas < 10 ? 'Últimas plazas' : 'Disponibles';
}
