<?php
include_once "Usuario.php";

function accionBorrar ($login){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarUsuario($login);
}

// NUEVO (requisito del examen): pide al modelo que incremente los saldos seleccionados.
function accionIncrementarSaldo(array $logins)
{
    // getModelo devuelve el único AccesoDatos y reutiliza su conexión a la base de datos.
    $db = AccesoDatos::getModelo();
    $db->actualizarSaldos($logins);
}

// NUEVO (requisito del examen): pide al modelo que actualice los bloqueos según los checkboxes.
function accionActualizarBloqueos(array $logins)
{
    // getModelo devuelve el mismo objeto AccesoDatos para ejecutar la actualización.
    $db = AccesoDatos::getModelo();
    $db->actualizarBloqueos($logins);
}

function accionTerminar(){
    // closeModelo libera la conexión y elimina el objeto único antes de cerrar la sesión.
    AccesoDatos::closeModelo();
    // NUEVO (requisito del examen): elimina la sesión al pulsar Terminar.
    $_SESSION = [];
    session_destroy();
    // Redirige a index.php; al no haber sesión, volverá a solicitar el PIN.
    header('Location: index.php');
    exit;
}


function accionAlta(){
    $user = new Usuario();
    $user->nombre  = "";
    $user->login   = "";
    $user->password   = "";
    $user->comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password   = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    $db = AccesoDatos::getModelo();
    $db->addUsuario($user);
    
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password  = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    $db = AccesoDatos::getModelo();
    $db->modUsuario($user);
    
}

