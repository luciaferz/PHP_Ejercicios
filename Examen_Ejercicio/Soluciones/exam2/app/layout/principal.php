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
<h1>GESTIÓN DE USUARIOS - Solución Control </h1>
</div>
<div id="content">
<!-- NUEVO (requisito del examen): el formulario envía juntos los checkboxes y la orden elegida. -->
<form>
<?= $contenido ?>

<input type="submit" name="orden" value="Nuevo">
<input type="submit" name="orden" value="Terminar">
<!-- NUEVO (requisito del examen): botones para aplicar saldo y bloqueo a los usuarios marcados. -->
<button name="orden" value="MasSaldo"> Incrementar Saldo </button>
<button name="orden" value="Bloquear"> Cambiar Bloqueos </button>

</form>
</div>
</div>
</body>
