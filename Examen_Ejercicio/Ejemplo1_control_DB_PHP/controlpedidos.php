<?php
require_once "Cliente.php";
require_once "Pedido.php";
require_once "AccesoDatos.php";

$msgError="";

// Si falta algún dato del formulario, muestra el error y termina.
if(empty($_GET['nombre']) || empty($_GET['clave'])){
    $msgError = "Introduczca el valor Nombre de usuario y/o contraseña";
    include "vistaerror.php";
    die();
}

// Obtiene el modelo de acceso a datos, que crea la conexión PDO si aún no existe.
$ac = AccesoDatos::initModelo();

$nombre = $_GET['nombre'];
$clave = $_GET['clave'];

$cliente = $ac->getCliente($nombre, $clave);
if ($cliente == null) {
    $msgError = "ERROR.Nombre de usuario o contraseña incorrectos";
    include "vistaerror.php";
    exit();
}

// Registra una visita solo después de validar al cliente.
$ac->incrementarAccesos($cliente->cod_cliente);

// El objeto se obtuvo antes del UPDATE, por eso sumamos uno al valor leído.
$veces = $cliente->veces + 1;
$msgBienvenida = "Bienvenido usuario: " . $cliente->nombre .
    ". Has entrado " . $veces . " veces en nuestra web.";

$pedidos = $ac->getPedidosClientes($cliente->cod_cliente);

$total = 0;
foreach ($pedidos as $pedido) {
    $total += $pedido->precio;
}

include 'vistapedidos.php';