/*3-   Obtener un número al azar entre 1 y 9 y generar una pirámide con ese número de peldaños.
Utilizar la marca <code></code> para que la visualización no se deforme por el tamaño de los espacio o una estilo con tipo de letra monospace.*/

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    $num = random_int(1, 9);

    echo "<code>";
    
    for ($i = 1; $i <= $num; $i++) {
    
        // Espacios
        for ($j = 1; $j <= $num - $i; $j++) {
            echo " ";
        }
    
        // Asteriscos
        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo "*";
        }
    
        echo "<br>";
    }
    
    echo "</code>";

    ?>
    
</body>
</html>