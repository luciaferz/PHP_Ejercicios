<?php

// Configuración
$uploadsDir = __DIR__ . '/uploads/';
$maxFileSize = 10240; // 10 KB
$allowedMimeType = 'image/png';

// Crear la carpeta uploads si no existe
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// Variables
$nombre = '';
$alias = '';
$edad = '';
$arma = '';
$magia = '';
$imagenError = '';
$imagenPath = '';

// Si entramos directamente por GET, mostramos el formulario
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Location: captura.html');
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger datos
    $nombre = htmlspecialchars($_POST['nombre'] ?? '', ENT_QUOTES, 'UTF-8');
    $alias = htmlspecialchars($_POST['alias'] ?? '', ENT_QUOTES, 'UTF-8');
    $edad = htmlspecialchars($_POST['edad'] ?? '', ENT_QUOTES, 'UTF-8');
    $arma = htmlspecialchars($_POST['arma'] ?? '', ENT_QUOTES, 'UTF-8');
    $magia = htmlspecialchars($_POST['magia'] ?? '', ENT_QUOTES, 'UTF-8');

    // Comprobar si se ha subido una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {

        // Comprobar errores de subida
        if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {

            $imagenError = 'Ha ocurrido un error al subir la imagen.';

        } else {

            $fileTmpPath = $_FILES['imagen']['tmp_name'];
            $fileSize = $_FILES['imagen']['size'];

            // Comprobar tipo MIME
            $fileMimeType = mime_content_type($fileTmpPath);

            // Comprobar tipo de archivo
            if ($fileMimeType !== $allowedMimeType) {

                $imagenError = 'El archivo debe ser una imagen PNG.';

            // Comprobar tamaño
            } elseif ($fileSize > $maxFileSize) {

                $imagenError = 'La imagen no puede superar los 10 KB.';

            } else {

                // Crear un nombre nuevo para la imagen
                $fileName = uniqid('img_') . '.png';

                // Ruta donde se guardará
                $imagenPath = $uploadsDir . $fileName;

                // Intentar guardar la imagen
                if (move_uploaded_file($fileTmpPath, $imagenPath)) {

                    // Se ha guardado correctamente
                    $imagenPath = 'uploads/' . $fileName;

                } else {

                    $imagenError = 'No se ha podido guardar la imagen. Comprueba que la carpeta uploads tenga permisos de escritura.';
                    $imagenPath = '';
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Datos del Jugador</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #ffeb3b;

            padding: 40px;

            border-radius: 20px;

            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);

            width: 800px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 40px;
        }

        .info {
            flex: 1;
        }

        .info h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .info p {
            font-size: 18px;
        }

        .card img {
            max-width: 250px;
            max-height: 250px;

            border-radius: 15px;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .volver {
            display: inline-block;

            margin-top: 20px;

            padding: 10px 20px;

            background-color: #007BFF;
            color: white;

            text-decoration: none;

            border-radius: 8px;
        }

    </style>

</head>

<body>

    <div class="card">

        <div class="info">

            <h1>Datos del Jugador</h1>

            <p>
                <strong>Nombre:</strong>
                <?php echo $nombre; ?>
            </p>

            <p>
                <strong>Alias:</strong>
                <?php echo $alias; ?>
            </p>

            <p>
                <strong>Edad:</strong>
                <?php echo $edad; ?>
            </p>

            <p>
                <strong>Arma:</strong>
                <?php echo $arma; ?>
            </p>

            <p>
                <strong>¿Practica artes mágicas?:</strong>
                <?php echo $magia; ?>
            </p>

            <?php if ($imagenError): ?>

                <p class="error">
                    Error en la imagen:
                    <?php echo htmlspecialchars($imagenError); ?>
                </p>

            <?php endif; ?>

            <a class="volver" href="captura.html">
                Volver
            </a>

        </div>


        <div>

            <?php if ($imagenPath): ?>

                <!-- Imagen que ha subido el usuario -->
                <img
                    src="<?php echo htmlspecialchars($imagenPath); ?>"
                    alt="Imagen del jugador"
                >

            <?php else: ?>

                <!-- Imagen que aparece si no se ha subido ninguna -->
                <img
                    src="uploads/calavera.png"
                    alt="Sin imagen"
                >

            <?php endif; ?>

        </div>

    </div>

</body>

</html>