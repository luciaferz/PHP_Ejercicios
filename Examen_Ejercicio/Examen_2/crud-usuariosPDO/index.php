<?php

session_start();

// NUEVO (requisito del examen): elimina la sesión completa cuando pasan cinco minutos.
if (isset($_SESSION['expira']) && time() >= $_SESSION['expira']) {
    $_SESSION = [];
    session_destroy();
    // Vuelve a index.php para que, sin sesión, aparezca el formulario del PIN.
    header('Location: index.php');
    exit;
}

// Si la sesión no tiene fecha de caducidad, tampoco se considera autorizado el acceso.
if (!isset($_SESSION['expira'])) {
    unset($_SESSION['acceso']);
}

// NUEVO (requisito del examen): si no hay acceso, solicita el PIN antes de mostrar la aplicación.
if (!isset($_SESSION['acceso'])) {
    if (
        // REQUEST_METHOD indica si se abrió la página (GET) o se envió el formulario (POST).
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['acceso'])
        && $_POST['acceso'] === '12345'
    ) {
        // Guarda que el PIN es correcto y fija la caducidad 5 minutos desde ahora.
        $_SESSION['acceso'] = true;
        $_SESSION['expira'] = time() + 300;
    } else {
        $error = '';

        // Si se envió un PIN incorrecto, prepara el mensaje que mostrará el formulario.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acceso'])) {
            $error = 'PIN incorrecto';
        }

        // Muestra el formulario del PIN y evita que se ejecute el resto de la aplicación.
        include 'app/layout/formulariopin.php';
        exit;
    }
}

// Solo se llega aquí después de validar el PIN o si la sesión sigue vigente.
include_once 'app/funciones.php';
include_once 'app/acciones.php';

// Div con contenido
$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
            // NUEVO (requisito del examen): envía los logins marcados para aumentar su saldo.
            case "IncrementarSaldo":
                $logins = isset($_GET['usuarios']) && is_array($_GET['usuarios']) ? $_GET['usuarios'] : [];
                accionIncrementarSaldo($logins);
                break;
            // NUEVO (requisito del examen): actualiza todos los bloqueos según las casillas marcadas.
            case "ActualizarBloqueos":
                $logins = isset($_GET['usuarios']) && is_array($_GET['usuarios']) ? $_GET['usuarios'] : [];
                accionActualizarBloqueos($logins);
                break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles": break; // No hago nada
         }
    }
}
$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";




