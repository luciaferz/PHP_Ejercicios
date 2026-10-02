<?php
function suma(int $num1, int $num2): int {}

function resta(int $num1, int $num2): int {}

function operar(int $num1, int $num2, callable $metodo): int{
    $resu;
    return $resu;
}

echo operar(10, 20, 'suma');

//Ordenar array
function compara(array $v1, array $v2): int
{
    return ($v1[1] - $v2[1]);
}

$datos = [['Pepe', 34], ["Juan", 23], ["Ana", 45]];

usort($datos, 'compara'); //Compara dos cosas y lo ordena

print_r($datos);
