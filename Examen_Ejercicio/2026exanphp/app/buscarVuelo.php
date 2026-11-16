<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';

// Recupera el contador de la cookie; si no existe o no es válido, empieza en cero.
$consultas = filter_var($_COOKIE['consultas'] ?? '0', FILTER_VALIDATE_INT);
if ($consultas === false || $consultas < 0) {
    $consultas = 0;
}

// Cuenta esta búsqueda y guarda el nuevo total durante una semana.
$consultas++;
setcookie('consultas', (string) $consultas, time() + 7 * 24 * 60 * 60, '/');

// Lee los valores enviados desde el formulario.
$destino = trim($_GET['destino'] ?? '');
$plazas = filter_var($_GET['plazas'] ?? '', FILTER_VALIDATE_INT);
$mensajeError = '';
$vuelos = [];

// Rechaza valores que no sean enteros entre 1 y 5.
if ($plazas === false || $plazas < 1 || $plazas > 5) {
    $mensajeError = 'El número de plazas no es correcto; debe ser entre 1 y 5.';
} else {
    // Obtiene el acceso a la base de datos solo cuando las plazas son válidas.
    $ac = AccesoDatos::initModelo();

    // Comprueba por separado si el destino existe para dar el mensaje adecuado.
    if ($destino === '' || !$ac->existeDestino($destino)) {
        $mensajeError = "No hay vuelos con destino $destino.";
    } else {
        // Busca vuelos del destino que tengan suficientes asientos libres.
        $vuelos = $ac->getVuelos($destino, $plazas);

        // Si el destino existe pero la búsqueda no devuelve vuelos, faltan plazas.
        if (count($vuelos) === 0) {
            $mensajeError = "No hay vuelos con plazas disponibles con destino $destino.";
        }
    }
}

// Carga la vista de error si hay mensaje; en otro caso muestra el listado.
if ($mensajeError !== '') {
    include 'vistas/error.php';
} else {
    include 'vistas/listado.php';
}


