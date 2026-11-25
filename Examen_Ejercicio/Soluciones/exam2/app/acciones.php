<?php
include_once "Usuario.php";

function accionBorrar ($login){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarUsuario($login);
}

function accionTerminar(){
    // closeModelo libera la conexión y elimina el objeto único antes de cerrar la sesión.
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
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

// NUEVO (requisito del examen): manda al modelo los logins cuyo saldo se debe incrementar.
function accionMasSaldo($tuser){
    // getModelo devuelve el único objeto AccesoDatos y reutiliza la conexión a la base de datos.
    $db = AccesoDatos::getModelo();
    $db->actualizarSaldos($tuser);
}



// NUEVO (requisito del examen): pide al modelo que ajuste los bloqueos según los checkboxes.
function accionBloquear($tuser){
    // getModelo devuelve el mismo objeto AccesoDatos para actualizar los bloqueos.
    $db = AccesoDatos::getModelo();
    $db->actualizarbloqueos2($tuser);
}



