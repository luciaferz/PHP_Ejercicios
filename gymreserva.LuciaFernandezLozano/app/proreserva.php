<?php
require_once "modelo/AccesoDatos.php";
require_once "modelo/Clase.php";
require_once "modelo/Socio.php";



//Recoger datos
$codigo_socio = filter_input(INPUT_POST, 'codigo_socio', FILTER_VALIDATE_INT);
$actividad = trim($_POST['actividad'] ?? '');
$plazas = filter_input(INPUT_POST, 'plazas', FILTER_VALIDATE_INT);

$ac = AccesoDatos::initModelo(); // Devuelve la única conexión Singleton.

//Comprobar datos
if (!$codigo_socio || $codigo_socio <= 0 || !$plazas || $plazas <= 0 || $actividad === '') {
    $mensaje = "Error: Los datos introducidos no son correctos.";
    require_once "vistas/verError.php";
    exit;
}

//Una vez hecha la reserva no se puede volver hacer hasta pasado 24 horas
if (isset($_COOKIE['codigo_socio'])) {
    $mensaje = "No pueden realizarse reservas hasta dentro de 24 horas";
    require_once "vistas/verError.php";
    exit;
}

$socio = $ac->obtenerSocio($codigo_socio);

if ($socio === null) {
    $mensaje = "No existe el socio";
    require_once "vistas/verError.php";
    exit;
}

//c
if ($socio->getBloqueado() == 1) {
    $mensaje = "El socio esta bloqueado";
    require_once "vistas/verError.php";
    exit;
}

$clase = $ac->obtenerClase($actividad, $plazas);

if ($clase === null) {
    $mensaje = "No hay plazas disponibles en la actividad seleccionada o no existe esa actividad.";
    require_once "vistas/verError.php";
    exit;
}

//Crear cookie
$actualizar = $ac->actualizarPlazas($clase->codigo_clase, $plazas);
if (!$actualizar || !$ac->incrementarAsistencia($codigo_socio)) {
    $mensaje = "No se ha podido completar la reserva.";
    require_once "vistas/verError.php";
    exit;
}

setcookie('codigo_socio', $codigo_socio, time() + 86400);
require_once "vistas/verReserva.php";
