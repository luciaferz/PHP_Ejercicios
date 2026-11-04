<?php
session_start();

include_once('app/funciones.php');

// Guarda en la sesión los intentos fallidos para mantener el contador entre solicitudes.
$_SESSION['intentosFallidos'] = $_SESSION['intentosFallidos'] ?? 0;
$maxIntentos = 5;

if ($_SESSION['intentosFallidos'] >= $maxIntentos) {
  // Al alcanzar el límite se muestra el aviso sin permitir otro intento.
  $accesoBloqueado = true;
  include_once('app/acceso.php');
} elseif (!empty($_GET['login']) && !empty($_GET['clave'])) {
  // acceso.php envía el formulario con GET, por eso se leen las credenciales de $_GET.
  if (userOk($_GET['login'], $_GET['clave'])) {
    // Un acceso correcto reinicia el contador de fallos.
    $_SESSION['intentosFallidos'] = 0;

    if (getUserRol($_GET['login']) == ROL_PROFESOR) {
      $contenido = verNotaTodas($_GET['login']);
    } else {
      $contenido = verNotasAlumno($_GET['login']);
    }
    include_once('app/resultado.php');
  } else {
    // Cada validación incorrecta consume un intento de la sesión.
    $_SESSION['intentosFallidos']++;

    if ($_SESSION['intentosFallidos'] >= $maxIntentos) {
      $accesoBloqueado = true;
    } else {
      $contenido = "El número de usuario y la contraseña no son válidos";
    }
    include_once('app/acceso.php');
  }
} else {
  $contenido = " Introduzca su número de usuario y su contraseña";
  include_once('app/acceso.php');
}

//Tocar index solo para la segunda aprte 
