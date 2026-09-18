/*2.-  Obtener un número al azar entre 1 y 9 y generar una la escalera numérica del tamaño indicado alternando colores entre rojo y azul.

Número generado 5
1
22
333
4444
55555 */

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

    for($i = 1; $i <= $num; $i++ ){

        if ($i % 2 == 1){
            $color = "red";
        }else{
            $color = "blue";
        }

        for ($j = 1; $j <= $i; $j++) {
            echo "<span style='color: $color;'>$i</span>";
        }
    
        echo "<br>";
    }

    
    ?>    

</body>
</html>