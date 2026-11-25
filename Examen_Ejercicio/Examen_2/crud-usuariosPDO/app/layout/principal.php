<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" >
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD</h1>
</div>
<div id="content">
<!-- NUEVO (requisito del examen): un formulario GET envía juntos la tabla, los checkboxes y la orden elegida. -->
<form method="get" action="index.php">
    <?= $contenido ?>
    <button name="orden" value="Nuevo">Nuevo</button>
    <button name="orden" value="Terminar">Terminar</button>
    <!-- NUEVO (requisito del examen): cada botón envía una orden distinta para los usuarios marcados. -->
    <button name="orden" value="IncrementarSaldo">Incrementar saldo</button>
    <button name="orden" value="ActualizarBloqueos">Actualizar bloqueos</button>
</form>
</div>
</div>
</body>
