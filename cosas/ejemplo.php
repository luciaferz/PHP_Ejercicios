<?php
echo "Hola mundo \n";


$valor= 33;
//incrementar numero
$valor++;

echo "El numero es $valor \n"; //mostrar valor 
echo 'El numero es $valor \n'; //cosa literal
echo "El numero es ". $valor . "\n"; //mostrar valor + concadenacion

//eliminar una variable
insert($valor);
echo "El numero es $valor \n"; //mostrar valor 

//El 0 se considera falso
