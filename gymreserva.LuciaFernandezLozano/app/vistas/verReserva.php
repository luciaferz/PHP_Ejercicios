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
    Muchas gracias <strong><?= htmlspecialchars($socio->nombre) ?></strong><br>
    Se ha reservado tu clase <strong><?= htmlspecialchars($clase->actividad) ?></strong><br>
    En la sala <strong><?= htmlspecialchars($clase->instalacion) ?></strong><br>
    Plazas reservadas: <strong><?= (int)$plazas ?></strong>
</body>
</html>
