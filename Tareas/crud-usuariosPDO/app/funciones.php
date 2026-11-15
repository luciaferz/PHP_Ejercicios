<?php
/* ================================================================
   FUNCIONES DEL CRUD DE PRODUCTOS
   ================================================================ */

// Escapa los valores antes de imprimirlos en HTML.
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

// Muestra todos los productos y sus acciones.
function mostrarDatos(): string {
    // Cabeceras de la tabla de productos.
    $titulos = ['Código','Nombre','Stock','Stock mínimo','Precio','Acciones'];
    $msg = "<table><tr>";
    foreach ($titulos as $titulo) $msg .= "<th>$titulo</th>";
    $msg .= "</tr>";

    // Obtiene las filas mediante el modelo de acceso a datos.
    foreach (AccesoDatos::getModelo()->getProductos() as $p) {
        $id = (int)$p['codigo'];
        $msg .= "<tr><td>".e($p['codigo'])."</td><td>".e($p['nombre'])."</td><td>".e($p['stock'])."</td><td>".e($p['stock_min'])."</td><td>".e($p['precio'])."</td>";
        $msg .= '<td><a href="?orden=Detalles&id='.$id.'">Ver</a> <a href="?orden=Modificar&id='.$id.'">Modificar</a> <a href="?orden=Borrar&id='.$id.'" onclick="return confirm(\'Borrar producto?\')">Borrar</a></td></tr>';
    }
    return $msg . "</table>";
}

/* Funciones para limpiar la entrada de posibles inyecciones. */
function limpiarEntrada(string $entrada): string { return strip_tags(trim($entrada)); }
function limpiarArrayEntrada(array &$entrada) {
    foreach ($entrada as $key => $value) $entrada[$key] = limpiarEntrada($value);
}

/*
 * En el CRUD original esta función llamaba a getUsuarios() y mostraba
 * nombre, login, password y comentario. La versión activa mantiene la
 * misma estructura, pero llama a getProductos().
 */

