<?php
/* PUNTO DE ENTRADA DEL CRUD: decide si muestra PIN, procesa órdenes o carga vistas. */
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';
// Div con contenido
$contenido = "";
$msg = "";


// NUEVO (requisito del examen): pide el PIN mientras no exista acceso en la sesión.
// La sesión evita pedir el PIN en cada petición mientras el acceso siga válido.
if (!isset($_SESSION["accesoconcedido"])) {
    if (!isset($_GET["pin"])) {
        include "app/layout/formulariopin.php";
        exit();
    } else if ($_GET["pin"] != "12345") {
        $msg = "Introduzca un pin correcto.";
        include "app/layout/formulariopin.php";
        exit();
    } else {
        $_SESSION["accesoconcedido"] = "si";
        $_SESSION["timeout"] = time();
        //header("Refresh:0");
    }
} 

// NUEVO (requisito del examen): cierra el acceso cuando pasan cinco minutos.
// 300 segundos equivalen a 5 minutos; después se cierra la sesión.
if ( time() - $_SESSION["timeout"] > 300 ) {
    accionTerminar();
    exit();
}


// GET navega por las acciones; POST procesa los datos de los formularios.
if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if (isset($_GET['orden'])) {
            switch ($_GET['orden']) {
                case "Nuevo":
                    accionAlta();
                    break;
                case "Borrar":
                    accionBorrar($_GET['id']);
                    break;
                case "Modificar":
                    accionModificar($_GET['id']);
                    break;
                case "Detalles":
                    accionDetalles($_GET['id']);
                    break;
                // NUEVO (requisito del examen): procesa las órdenes de saldo y bloqueo con los logins marcados.
                case "MasSaldo":
                    if (isset ($_GET['tuser'])){
                        accionMasSaldo($_GET['tuser']);
                    }
                    break;
                case "Bloquear":
                    if ( isset($_GET['tuser'])){
                    accionBloquear($_GET['tuser']);
                    } else {
                    accionBloquear([]);    
                    }
                    break;
                case "Terminar":
                    accionTerminar();
                    break;
            }
        }
    }
    // POST Formulario de alta o de modificación
    else {
        if (isset($_POST['orden'])) {
            switch ($_POST['orden']) {
                case "Nuevo":
                    accionPostAlta();
                    break;
                case "Modificar":
                    accionPostModificar();
                    break;
                case "Detalles":; // No hago nada
            }
        }
}

$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";
