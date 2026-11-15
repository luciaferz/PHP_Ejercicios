<?php

// MUESTRA TODOS LOS PRODUCTOS
function mostrarDatos (){
    
    $titulos = [ "Código", "Nombre", "Stock", "Stock mínimo", "Precio" ];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }  
    $msg .= "</tr>";
    $db = AccesoDatos::getModelo();
    $productos = $db->getProductos();
    foreach ($productos as $producto) {
        $msg .= "<tr>";
        $msg .= "<td>{$producto['codigo']}</td>";
        $msg .= "<td>{$producto['nombre']}</td>";
        $msg .= "<td>{$producto['stock']}</td>";
        $msg .= "<td>{$producto['stock_min']}</td>";
        $msg .= "<td>{$producto['precio']}</td>";
        $msg .= "</tr>\n";
    }
    $msg .= "</table>";
   
    return $msg;    
}

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada);
    $salida = strip_tags($salida);
    return $salida;
}

function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}
