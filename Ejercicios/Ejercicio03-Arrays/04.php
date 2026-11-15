<?php
/*Crear una carpeta que se llame img y copiar en ella 5 ficheros de imágenes 
que muestre el logo de un deporte. Crear una array asociativo que almacene 
como clave el nombre del deporte y como valor la dirección de la imagen.
Mostrar una tabla HTML donde con el siguiente formato: */

$deportes = [
    "Futbol" => "img/futbol.webp",
    "Golf" => "img/golf.png",
    "Baloncesto" => "img/baloncesto.webp",
    "Atletismo" => "img/atletismo.png",
    "Motocross" => "img/motocross.png"
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 80;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Deporte</th>
                <th>Logo</th>
            </tr>
            <?php foreach ($deportes as $nombre => $imagen) : ?>
                <tr>
                    <td><?php echo $nombre ?></td>
                    <td><img src="<?php echo $imagen ?>" width="100"></img></td>
                </tr>
            <?php endforeach; ?>
    </table>
</body>

</html>