<?php
/* CONTROLADOR DEL EXAMEN 1.
 * Recibe el formulario, valida, pide datos a AccesoDatos y decide entre vista
 * de error o listado. require_once evita cargar dos veces una clase. */


require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


$mensajeError="";
// Evito inyección html
$destino = htmlspecialchars($_GET['destino']); // Protege el texto antes de mostrarlo.
$plazas  = htmlspecialchars($_GET['plazas']);

// is_numeric comprueba que se pueda tratar como número y luego limitamos el rango.
if ( !is_numeric($plazas) || $plazas <0 || $plazas > 5){
    $mensajeError = "ERROR: El N.º de plazas no es correcto debe ser entre 1 y  5";
    include 'vistas/error.php';
    die();
}

$ac = AccesoDatos::initModelo(); // Devuelve la única conexión Singleton.
$hayVuelos = $ac->hayVuelos($destino);

if (! $hayVuelos){
    $mensajeError = "ERROR: No hay vuelos con destino ".$destino;
    include 'vistas/error.php';
    die();
}

// ACTUALIZO EL COOKIE SI LA CONSULTA ES CORRECTAS
$nconsultas = 0;
if (isset($_COOKIE['consultas'])) {
        $nconsultas = $_COOKIE['consultas'];
}
$nconsultas++;
// Hay que indicar el path  / para que permita desde cualquier ruta de mi servidor
// 3600 segundos=1 hora; 3600*24*7=604800 segundos=7 días.
setcookie("consultas",$nconsultas, time()+3600*24*7, "/");

$listaVuelos = $ac->getVuelos($destino,$plazas);

if ( count($listaVuelos) == 0){
     $mensajeError = " ERROR: No hay  vuelos con plazas disponibles con destino ".$destino;
    include 'vistas/error.php';
    die();
} 

include 'vistas/listado.php';



 
