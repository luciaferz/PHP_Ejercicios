<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    /**.- Definir dos variables asignándoles un valor entero aleatorio entre 1 y 10 y mostrar su suma, su resta, su división, 
     * su multiplicación, módulo y potencia

        1º Número : 5  
        2º Número : 2
        
        5+3  = 7
        5-2  = 3
        5*2  = 10
        5/ 2 = 2.5
        5%2  = 1
        5**2 = 25
        
        Nota_para obtener un número entero aleatoria existe la función  random_int(min,max)
        */

        $num1 = random_int(1, 10);
        $num2 = random_int(1, 10);

        echo $num1 . " + " . $num2 . " = " . $num1 + $num2 . "<br>";
    ?>

</body>
</html>