<?php
session_start();
require_once __DIR__ . '/precios.php';

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
    include __DIR__ . '/bienvenida.php';
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
        $compraRealizada = htmlTablaPedidos($precios);
        // Destruyo la sesión y vuelvo a la página de bienvenida
            include_once __DIR__ . '/despedida.php';
            session_destroy(); //borra datos de sesion pero no cierra la sesion
            exit(); //cierra la sesion
        break;
    }        

}

$compraRealizada = htmlTablaPedidos($precios);
require_once __DIR__ . '/compra.php';


// Función axiliar que genera una tabla HTML a partir  la tabla de pedidos
// Almacenada en la sesión
function htmlTablaPedidos(array $precios): string
{
    $msg = "<table><thead><tr><th>Fruta</th><th>Cantidad (kg)</th><th>Precio por kg</th><th>Subtotal</th></tr></thead><tbody>";
    $total = 0;

    foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
        $precio = $precios[$fruta]['precio'];
        $subtotal = $cantidad * $precio;
        $total += $subtotal;
        $msg .= "<tr><td>" . htmlspecialchars($precios[$fruta]['nombre']) . "</td><td>" . $cantidad . "</td><td>" . number_format($precio, 2, ',', '.') . " €</td><td>" . number_format($subtotal, 2, ',', '.') . " €</td></tr>";
    }
    $msg .= "<tr><th colspan=\"3\">Total</th><td>" . number_format($total, 2, ',', '.') . " €</td></tr></tbody></table>";

    return $msg;
}
