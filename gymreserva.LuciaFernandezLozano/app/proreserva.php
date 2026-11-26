<?php
require_once "modelo/AccesoDatos.php";
require_once "modelo/Clase.php";
require_once "modelo/Socio.php";



//Recoger datos
$codigo_socio = $_POST('codigo_socio') ?? '';
$codigo_clase = $_POST('actividad') ?? '';
$plazas_libres = $_POST('plazas') ?? '';

$ac = AccesoDatos::initModelo(); // Devuelve la única conexión Singleton.

//Comprobar datos
if (
    $codigo_socio <= 0 ||
    $plazas_libres <= 0
) {
    $mensaje = "Error: Los datos introducidos no son correctos.";
    require_once "vistas/verError.php";
}

//Una vez hecha la reserva no se puede volver hacer hasta pasado 24 horas
if (isset($_COOKIE['codigo_socio'])) {
    $mensaje = "No pueden realizarse reservas hasta dentro de 24 horas";
    require_once "vistas/verError.php";
    exit;
}

$socio = $ac->obtenerSocio($codigo_socio);

if ($codigo_socio == null) {
    $mensaje = "No existe el socio";
    require_once "vistas/verError.php";
    exit;
}

//c
if ($socio->getBloqueado == 1) {
    $mensaje = "El socio esta bloqueado";
    require_once "vistas/verError.php";
    exit;
}

$clase = $ac->obtenerClase($codigo_clase);

if ($codigo_clase == null) {
    $mensaje = "No existe la actividad";
    require_once "vistas/verError.php";
    exit;
}

$plazas = $ac->obtenerClase($codigo_clase);

if ($codigo_clase == null) {
    $mensaje = "No hay plazas disponibles para la actividad";
    require_once "vistas/verError.php";
    exit;
}

//Crear cookie
$actualizar = $ac->actualizarPlazas($codigo_clase, $plazas);
$asistencia = $ac->incrementarAsistencia($codigo_clase);

setcookie('codigo_socio', $codigo_socio, time() + 86400);
require_once "vistas/verReserva.php";
