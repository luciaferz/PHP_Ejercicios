<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos del cliente</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px 12px;
        }
    </style>
</head>
<body>
    <h2><?= htmlspecialchars($msgBienvenida) ?></h2>

    <?php if (empty($pedidos)): ?>
        <p>No existen pedidos para este cliente.</p>
    <?php else: ?>
        <p>Esta es su lista de pedidos del cliente con código <?= htmlspecialchars($cliente->cod_cliente) ?>:</p>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido->producto) ?></td>
                        <td><?= htmlspecialchars((string) $pedido->precio) ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total pedidos</th>
                    <td><?= htmlspecialchars($total) ?> €</td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</body>
</html>