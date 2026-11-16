<?php
/**Se desea implementar una clase denominada Reloj que codifique el funcionamiento básico de una reloj con alarma. 
 * Para ello se definen los siguientes atributos y métodos

Atributos: Todos privados
 Métodos de instancia:
•	Segundos: un entero donde se guardan los segundos desde las 00:00:00;
•	Formato24: valor lógico , indica si la información a mostrar el 24 o 12 horas
 
Métodos:
1)  Constructor  donde se indica la hora, minutos y segundos con los que se inicia el reloj. El formato de hora es por defecto en 24.

2)  Mostrar la hora: genera un String con el  formado de hora  22:30:23 o 10:30:23 pm si el atributos Formato24 es falso

3)Cambiar formato24  que recibe un valor true si quiero formato de 24 o falso si quiero de 12

4)  Tictac : incrementa en  un segundo el valor de reloj

5) Comparar Hora, recibe como parámetro otro objeto Reloj y me devuelve el número de segundos que tiene de diferencia con el objeto.
 */


/** Prueba de la clase Reloj*/
include_once 'Reloj.php';

$r1 = new Reloj(20,10,10);
$r2 = new Reloj(20,10,15);

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();

for ($i=1; $i<= 5; $i++){
    $r1->tictac();
}

if ( $r1->comparar($r2) == 0){
    echo " <br> Están en la misma hora <br>";
}

$r1->cambiarFormato24(false);
$r2->cambiarFormato24(false);

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();

// Incremento la hora en una serie de segundos

for ($i=1; $i<= 50000; $i++){
    $r1->tictac();
}

for ($i=1; $i<= 100000; $i++){
    $r2->tictac();
}

echo "<br> Los relojes se diferencias en ". $r1->comparar($r2) .
         " segundos <br> ";

$r1->cambiarFormato24(true);
$r2->cambiarFormato24(true);

echo " <br> Reloj nº 1 ". $r1->mostrar();
echo " <br> Reloj nº 2 ". $r2->mostrar();


class Reloj
{
    private $segundos;
    private $formato24;
    
    public function __construct ( int $hora, int $minutos, int $segundos){
        
    }
    
    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    
    public function mostrar(){
        
        return "";
    }
    
    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
        
    }
    
    // Incrementa en un segundo el valor de reloj
    public function tictac (){
        
    }
    
    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia
    
    public function comparar ( Reloj $otroreloj){
        
        return 0;
    }    
}


?>