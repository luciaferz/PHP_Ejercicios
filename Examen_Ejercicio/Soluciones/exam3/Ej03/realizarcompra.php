<?php
// MEJORAS:
// -- implementar totalmente MVC 
// -- Añadir un campo de stock en productos.

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
	
<?php 
include_once 'AccesoDatos.php';
include_once 'Producto.php';
include_once 'Socio.php';


if ( empty($_POST['codigo_socio']) || empty($_POST['clave']) || empty ($_POST['codigo_producto']) ){
    echo "ERROR: Debe rellenar todos los valores <br><body></html>";
    exit;
}

$cod_socio    = $_POST['codigo_socio'];
$clave        = $_POST['clave'];
$cod_producto = $_POST['codigo_producto'];

$db = AccesoDatos::initModelo();

// Chequeo el socio
$socio  = $db->buscarSocio($cod_socio,$clave);
if ( $socio == null){
    echo "ERROR:  Los valores de código de cliente y contraseña no son válidos <br><body></html>";
    exit;
}
// Cheque el producto
$producto = $db->buscarProducto($cod_producto);
if ( $producto == null){
    echo " <br> ERROR:  No se encuentra ningún producto con el código $cod_producto en nuestro catálogo<body></html>";
    exit;
}

echo " BIENVENIDO/A  $socio->nombre <br>";

// Compruebo si la cantidad_max es menos que el producto que ha elegido
if ( $socio->cantidad_max < $producto->precio){
    echo "NO se ha podido efectuar la compra del producto: $producto->nombre_pro por $producto->precio Euros <br>";
    echo "Su límite actual de compra es de $socio->cantidad_max Euros.";
} else {
    //Se puede realizar la compra, actualizo la compra
    $db->actualizarSocio($cod_socio,$producto->precio);
    echo "Se ha efectuado la compra del producto: $producto->nombre_pro por $producto->precio Euros <br>";
    echo "Su nuevo límite actual de compra es de ".($socio->cantidad_max - $producto->precio)." Euros.";	
}
echo "</body></html>";


