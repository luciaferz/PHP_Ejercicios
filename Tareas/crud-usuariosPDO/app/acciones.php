<?php
/*
// ---------------- ACCIONES DE USUARIOS ----------------
function accionBorrarUsuario($login){
    $db = AccesoDatos::getModelo();
    $db->borrarUsuario($login);
}

function accionAltaUsuario(){
    $user = new Usuario();
    $user->nombre = '';
    $user->login = '';
    $user->password = '';
    $user->comentario = '';
    $orden = 'Nuevo';
    include 'layout/formulario.php';
}

function accionDetallesUsuario($login){
    $user = AccesoDatos::getModelo()->getUsuario($login);
    $orden = 'Detalles';
    include 'layout/formulario.php';
}

function accionModificarUsuario($login){
    $user = AccesoDatos::getModelo()->getUsuario($login);
    $orden = 'Modificar';
    include 'layout/formulario.php';
}
*/

/* ================================================================
   ACCIONES  DEL CRUD DE PRODUCTOS
   ================================================================ */

// Recoge y convierte los datos enviados desde el formulario.
function productoPost(): array
{
    return ['codigo' => (int)$_POST['codigo'], 
        'nombre' => $_POST['nombre'], 
        'stock' => (int)$_POST['stock'], 
        'stock_min' => (int)$_POST['stock_min'], 
        'precio' => (float)$_POST['precio']];
}

// Muestra el formulario en modo alta, detalle o modificación.
function formularioProducto(array $producto, string $orden)
{
    include 'app/layout/formulario.php';
}

function accionAlta()
{
    formularioProducto(['codigo' => '', 'nombre' => '', 'stock' => '', 'stock_min' => '', 'precio' => ''], 'Nuevo');
}

function accionDetalles(int $id)
{
    formularioProducto(AccesoDatos::getModelo()->getProducto($id), 'Detalles');
}

function accionModificar(int $id)
{
    formularioProducto(AccesoDatos::getModelo()->getProducto($id), 'Modificar');
}

// Acciones GET de detalle, modificación y borrado.
function accionBorrar(int $id)
{
    AccesoDatos::getModelo()->borrarProducto($id);
    header('Location: index.php');
    exit;
}

// Acciones POST de alta y modificación.
function accionPostAlta()
{
    AccesoDatos::getModelo()->addProducto(productoPost());
    header('Location: index.php');
    exit;
}

function accionPostModificar()
{
    AccesoDatos::getModelo()->modProducto(productoPost(), (int)$_POST['codigoOriginal']);
    header('Location: index.php');
    exit;
}

function accionTerminar()
{
    AccesoDatos::closeModelo();
    header('Location: index.php');
    exit;
}
