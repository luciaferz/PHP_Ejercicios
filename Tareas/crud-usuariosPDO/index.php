<?php
session_start();
/*
 * Controlador principal adaptado del ejemplo CRUD de Usuarios.
 * La parte activa trabaja con Productos; el código original de usuarios
 * se conserva en AccesoDatos.php como referencia.
 */
require_once 'app/dat/AccesoDatos.php';
require_once 'app/funciones.php';
require_once 'app/acciones.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    limpiarArrayEntrada($_POST);
    if ($_POST['orden']==='Nuevo') accionPostAlta();
    if ($_POST['orden']==='Modificar') accionPostModificar();
}
if (isset($_GET['orden'])) {
    $id=(int)($_GET['id']??0);
    switch ($_GET['orden']) {
        case 'Nuevo': accionAlta(); exit;
        case 'Detalles': accionDetalles($id); exit;
        case 'Modificar': accionModificar($id); exit;
        case 'Borrar': accionBorrar($id); exit;
        case 'Terminar': accionTerminar(); exit;
    }
}
$contenido=mostrarDatos();
include 'app/layout/principal.php';

