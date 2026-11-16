<?php 
/**
 *  Genera una cadena un texto de la clase -> 1: Turista, 2: Business, 3: First Class
 * @param int $num
 * @return string - Texto asociado al valor del número
 */
function verClase( int $num):string {
     return "Turista";//Modificar 1.urista, 2: Business, 3: First Class
    };

/**
 *  Muestra un mensaje según el valor de plazas, si es menor de 10  devuelve 
 *  la cadena 'Ultimas plazas' y es caso contrario 'Disponibles'
 * @param int $plazas
 * @return string
 */
function verEstado ( int $plazas):string {
    return "Disponible";
}
