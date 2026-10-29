<?php
session_start();

// Manejo de la sesión con dos valores
// 'cliente' => nombre del cliente
// 'pedidos' => array asociativo fruta => cantidad


// Nuevo cliente: anoto en la sesión su nombre y creo su tabla de pedidos vacía
if (isset($_GET['cliente'])) {
    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pedidos'] = [];
    }

// No hay definido un cliente todavía en la session 
if (!isset($_SESSION['cliente'])) {
    include "bienvenida.php";
    die();
}


// Proceso las acciones 
if (isset($_POST["accion"])) {

switch ($_POST["accion"]) {
     case " Anotar ":
        $fruta = $_POST['fruta'];
        $cantidad = $_POST['cantidad'];
        // Actualizo la tabla de pedidos en la sesión
        $_SESSION['pedidos'][$fruta] = ($_SESSION['pedidos'][$fruta] ?? 0) + $cantidad;
        break;
    case " Anular ":
        $fruta = $_POST['fruta'];
        // Vacío la tabla de pedidos en la sesión
        unset($_SESSION['pedidos'][$fruta]);

        break;
    case " Terminar ": 
        $compraRealizada = htmlTablaPedidos();
        // Destruyo la sesión y vuelvo a la página de bienvenida
            include_once "despedida.php";
            session_destroy(); //borra datos de sesion pero no cierra la sesion
            exit(); //cierra la sesion
        break;
    }        

}

$compraRealizada = htmlTablaPedidos();
require_once 'compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(): string
{
    $msg = "";
    //crear una tabla
    $msg .= "<table>";//convertir la info del php en una tabla html para que aparezaca en la web
    foreach($_SESSION['pedidos'] as $fruta=> $cantidad){
        $msg .= "<tr><td>" .$fruta .":" ."</td><td>" .$cantidad ."</td></tr>";
    }
    $total = array_sum($_SESSION['pedidos']);
    $msg .= "<tr><th>Total de unidades:</th><td>$total</td></tr></table>";

    return $msg;
}
