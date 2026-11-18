<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Pasados 4 segundos se redirecciona automaticamente al fichero acceso.html-->
    <meta http-equiv="refresh" content="4;url=acceso.html">
    <title>Error de acceso</title>
</head>
<body>
    <h1>Error de acceso</h1>
    <p><?= htmlspecialchars($msgError) ?></p>
    <p>Volverás al formulario en unos segundos.</p>
</body>
</html>