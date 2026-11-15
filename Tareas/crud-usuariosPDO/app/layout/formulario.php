<!--
    Formulario adaptado del formulario original de Usuarios.
    Sus campos corresponden ahora a la tabla Productos.
-->
<!DOCTYPE html>
<html lang="es"><head><meta charset="UTF-8"><title>CRUD DE PRODUCTOS</title><link href="web/default.css" rel="stylesheet"></head>
<body><div id="container"><div id="header"><h1>GESTIÓN DE PRODUCTOS</h1></div><div id="content">
<form method="POST">
<input type="hidden" name="codigoOriginal" value="<?= e($producto['codigo']) ?>">
<table>
<tr><td>Código</td><td><input name="codigo" type="number" value="<?= e($producto['codigo']) ?>" <?= $orden==='Detalles'||$orden==='Modificar'?'readonly':'' ?> required></td></tr>
<tr><td>Nombre</td><td><input name="nombre" value="<?= e($producto['nombre']) ?>" <?= $orden==='Detalles'?'readonly':'' ?> required></td></tr>
<tr><td>Stock</td><td><input name="stock" type="number" value="<?= e($producto['stock']) ?>" <?= $orden==='Detalles'?'readonly':'' ?> required></td></tr>
<tr><td>Stock mínimo</td><td><input name="stock_min" type="number" value="<?= e($producto['stock_min']) ?>" <?= $orden==='Detalles'?'readonly':'' ?> required></td></tr>
<tr><td>Precio</td><td><input name="precio" type="number" step="0.01" value="<?= e($producto['precio']) ?>" <?= $orden==='Detalles'?'readonly':'' ?> required></td></tr>
</table>
<?php if ($orden !== 'Detalles'): ?><button name="orden" value="<?= $orden ?>"><?= $orden ?></button><?php endif; ?>
<a href="index.php">Volver</a>
</form></div></div></body></html>
