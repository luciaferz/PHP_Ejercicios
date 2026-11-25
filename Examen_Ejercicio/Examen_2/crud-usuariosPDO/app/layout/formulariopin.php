<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso</title>
    <link href="web/default.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Acceso a la aplicación</h1>
    </div>
    <div id="content">
        <!-- NUEVO (requisito del examen): formulario que solicita el PIN de acceso. -->
        <form method="post" action="index.php">
            <label for="acceso">Introduce el PIN:</label>
            <input type="password" id="acceso" name="acceso" required autofocus>
            <input type="submit" value="Acceder">
        </form>

        <?php if ($error !== ''): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
