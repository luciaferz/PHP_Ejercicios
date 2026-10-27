/*4.- Generar números al azar entre 1 y 10 hasta que se generen 3 veces el valor 6 de forma consecutiva en ese caso se mostrará cuantos número se han generado.

Han salido tres 6 seguidos tras genera 1343 números en 1.002 milisegundos

Para obtener los segundos utilizamos la función microtime(true) para obtener la fecha actual en segundos.*/


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $contador = 0;
    $seis = 0;

    $inicio = microtime(true);

    while($seis < 3){
        $num = random_int(1, 10);
        $contador++;

        if($num == 6){
            $seis++;
        }else{
            $seis=0;
        }
    }

    $fin = microtime(true);

    $tiempo = ($inicio - $fin) * 1000;

    echo "Numeros generados ". $contador. " en los segundos ". $tiempo;
    
    ?>

</body>

</html>