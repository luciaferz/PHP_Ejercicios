<?php
/*Rellenar un array con 20 números aleatorios entre 1 y 10 y mostrar el contenido del array  
mediante una tabla de una fila en HMTL. Mostrar a continuación el valor máximo, el mínimo y el  
valor que mas veces se repite. (Nota definir funciones para cada caso) */

$num = [];

//Crear un array con 20 números aleatorios entre 1 y 10
for($i=0; $i < 20; $i++){
    $num[] = rand(1,10);
}

//Funciones para mostrar valor maximo, minimo y valor que mas veces se repite
function maximo(array $arr): int{

    return max($arr); //Función que devuelve el valor máximo del array
}

function minimo(array $arr): int{

    return min($arr);//Función que devuelve el valor mínimo del array
}

function valorRepetido(array $arr): int {

    $repeticion = array_count_values($arr); //Función que devuelve un array con los valores y su cantidad de repeticiones  

    return array_search(max($repeticion), $repeticion); //Función que devuelve el valor que más veces se repite
}


?>

<!-- Tabla HTML para mostrar el contenido del array -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
        <table border="1">
            <tr>
                <?php foreach($num as $n): ?>
                    <td><?php echo $n; ?></td>
                <?php endforeach; ?> <!-- Cerrar el foreach -->
            </tr>
        </table>
    
        <p>Valor máximo: <?php echo maximo($num); ?></p>
        <p>Valor mínimo: <?php echo minimo($num); ?></p>
        <p>Valor que más veces se repite: <?php echo valorRepetido($num); ?></p>
    
</body>
</html>