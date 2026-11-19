<?php

require_once __DIR__ . '/AccesoDatos.php';

// Obtiene la instancia única encargada de las operaciones con la base de datos.
$bd = AccesoDatos::initModelo();

// Guarda el mensaje que se mostrará si ya se actualizó hoy.
$error = null;

// Procesa el formulario solo cuando se envía por POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orden'])) {
    $hoy = date('Y-m-d');

    // La cookie registra la fecha de la última actualización de este navegador.
    if (isset($_COOKIE['ultima_actualizacion'])
        && $_COOKIE['ultima_actualizacion'] === $hoy) {
        $error = 'Ya has actualizado los precios hoy.';
    } else {
        // El formulario envía los números de los productos marcados.
        $seleccionados = $_POST['tproductos'] ?? [];

        if (is_array($seleccionados) && count($seleccionados) > 0) {
            $bd->actualizarPrecios($seleccionados);
            // La cookie caduca mañana, así se permitirá otra actualización otro día.
            setcookie('ultima_actualizacion', $hoy, strtotime('tomorrow'));
        }
    }
}

// Vuelve a cargar los productos para mostrar la lista y los precios actualizados.
$tproductos = $bd->getStock();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
        </div>
        <div id="content">
            <?php if ($error !== null): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form name='entrada' method="post">
                <table>
                    <tr>
                        <th></th>
                        <th>N.º</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                    </tr>
                    <!-- Cada producto se muestra en una fila con su checkbox. -->
                    <?php foreach ($tproductos as $pro): ?>
                        <tr>
                            <td><input type="checkbox" name="tproductos[]" value="<?= $pro->producto_no ?>"></td>
                            <td><?= $pro->producto_no ?></td>
                            <td><?= $pro->descripcion  ?></td>
                            <td><?= $pro->stock_disponible ?></td>
                            <td><?= $pro->precio_actual ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <input type="submit" name="orden" value="ACTUALIZAR">
            </form>
        </div>
    </div>
</body>

</html>