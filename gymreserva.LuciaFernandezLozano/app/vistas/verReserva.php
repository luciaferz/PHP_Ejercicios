<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error en la Reserva</title>
     <link rel="stylesheet" href="../estilos.css">
    
</head>
<body>
    <div class="container">
        <img src="../logo.png"  class="logo-img">
        <h2>ACTIVIDAD RESERVADA </h2>
    
    <!-- COMPLETAR  DATOS DE LA RESERVA -->
    Muchas gracias <p><?= htmlspecialchars($socio->nombre) ?></p><BR>
    Se ha reservador su clase <p><?= htmlspecialchars($clase->actividad) ?></p> <br>
    En la sala<p><?= htmlspecialchars($clase->instalacion) ?></p> <br><br>
</body>
</html>