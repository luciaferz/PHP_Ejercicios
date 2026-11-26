<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error en la Reserva</title>
    <link rel="stylesheet" href="../estilos.css">

</head>

<body>
    <div class="container">
        <img src="../logo.png" class="logo-img">
        <h2>ERROR AL RESERVA TU CLASE</h2>
        <?php echo $mensaje; ?>
        <!-- COMPLETAR INDICAR MENSAJE DE ERROR -->
        <p><?= htmlspecialchars($mensaje) ?></p> <!--Mensaje de error de proreservas-->
        <a href="/gymreserva.LuciaFernandezLozano/index.html">
            <button value="Volver">Volver</button>
        </a>

</body>

</html>