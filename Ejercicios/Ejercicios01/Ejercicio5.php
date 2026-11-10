<?php
$num1 = random_int(1, 10);
$num2 = random_int(1, 10);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones con dos números</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 12px;
        }
    </style>
</head>

<body>

    <p>1º Número: <strong><?= $num1 ?></strong></p>
    <p>2º Número: <strong><?= $num2 ?></strong></p>

    <table>
        <thead>
            <tr>
                <th>Operación</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $num1 ?> + <?= $num2 ?></td>
                <td><?= $num1 + $num2 ?></td>
            </tr>
            <tr>
                <td><?= $num1 ?> - <?= $num2 ?></td>
                <td><?= $num1 - $num2 ?></td>
            </tr>
            <tr>
                <td><?= $num1 ?> * <?= $num2 ?></td>
                <td><?= $num1 * $num2 ?></td>
            </tr>
            <tr>
                <td><?= $num1 ?> / <?= $num2 ?></td>
                <td><?= $num1 / $num2 ?></td>
            </tr>
            <tr>
                <td><?= $num1 ?> % <?= $num2 ?></td>
                <td><?= $num1 % $num2 ?></td>
            </tr>
            <tr>
                <td><?= $num1 ?><sup><?= $num2 ?></sup></td>
                <td><?= $num1 ** $num2 ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>