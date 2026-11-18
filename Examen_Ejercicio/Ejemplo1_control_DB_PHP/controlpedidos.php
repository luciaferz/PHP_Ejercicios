<?php
require_once "Cliente.php";
require_once "Pedido.php";
require_once "AccesoDatos.php";

$msgError="";

// Si falta algún dato del formulario, muestra el error y termina.
if(empty($_GET['nombre']) || empty($_GET['clave'])){
    $msgError = "Nombre de usuario o contraseña incorrectos";
    include "vistaerror.php";
    die();
}

$nombre = $_GET['nombre'];
$clave = $_GET['clave'];

// Obtiene el modelo de acceso a datos, que crea la conexión PDO si aún no existe.
$ac = AccesoDatos::initModelo();

$cliente = $ac->getCliente($nombre, $clave);
if ($cliente === null) {
    $msgError = "Nombre de usuario o contraseña incorrectos";
    include "vistaerror.php";
    die();
}

// Registra una visita solo después de validar al cliente.
$ac->incrementarAccesos($cliente->cod_cliente);

// El objeto se obtuvo antes del UPDATE, por eso sumamos uno al valor leído.
$veces = (int) $cliente->veces + 1;
$msgBienvenida = "Bienvenido usuario: " . $cliente->nombre .
    ". Has entrado " . $veces . " veces en nuestra web.";

$pedidos = $ac->getPedidosClientes($cliente->cod_cliente);

$total = 0;
foreach ($pedidos as $pedido) {
    $total += $pedido->precio;
}

include 'vistapedidos.php';