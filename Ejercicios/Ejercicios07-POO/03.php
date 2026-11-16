<?php
/**Se desea implementar una clase denominada Coche que codifique el funcionamiento básico de una vehículo. 
 * Para ello se definen los siguientes atributos y métodos

Atributos: Todos privados
     
Atributos de instancia:
•	Modelo:  Una cadena con el modelo de vehículo.
•	Distancia Total: Total de kilómetros recorridos
•	Distancia Parcial: Total de kilómetros desde que el coche se ha arrancado
•	Motor: Arrancado o parado ( true / false)
•	Velocidad: Un entero con la velocidad en km/h
•	VelocidadMax : Máxima velocidad con la que puede circular el vehículo  
   
Métodos:
1)  Constructor: donde se indica el Modelo del coche y el máximo de velocidad, el resto de atributos se inicial izan a cero con el motor apagado

2)  Arrancar: Activa el motor.

3) Parar: Para el motor y pone el contador parcial a 0 km y la velocidad a 0

4) Acelera: Incrementa la velocidad en un cantidad

5) Frena: Decrementa la velocidad en un cantidad

6) Recorre: Incrementa los kilómetros en la velocidad que lleve el coche

6) Info: Muestra el modelo, la velocidad actual, el estado, kilómetros parciales y totales

7) getKilometros : Me devuelve la distancia recorrida desde que se arranco.

8) infoError es un método privado que muestra  que se ha intentado realizar una operación errónea sobre el coche.

Condiciones a cumplir:

1) No se puede arrancar el coche si  ya se ha arrancado.
2) No se puede superar la velocidad máxima
3) No se puede frenar si la velocidad es 0
4) No se puede parar si el coche ya está parado
5) Si el coche esta parado no se puede frenar, acelerar o recorrer

Si no se cumple la condiciones los método implicados devolverán false indicando que la operación no se ha podido realizar y  llamarán a infoError para que escriba un mensaje informativo.

 */

namespace pruebas00\taller\POO;

class Coche
{
    // Definir los atributos
    
    
    // Completar los métodos
    
    function __construct ( String $modelo, int $velocidadMax){
        
    }
    
    public function  arrancar():bool{
        return true;
    }
    
    public function parar():bool{
        return true;
    }
    
    public function acelera( int $cantidad):bool{
        return true;
    }
    
    public function frena ( int $cantidad):bool{
        return true;
    }
    
    public function recorre ():bool{
        return true;
    }
    
    public function info():string{
        return "";
    }
    
    public function getKilometros():int{
        return 0;
    }
    
    private function infoError( String $mensaje):void{
        
    }	
}
 
/*
 *  CLASE DE PRUEBA: Realiza una simulación sencilla de una carrera de coches
 */

namespace pruebas00\taller\POO;
include_once "Coche.php";

const META = 500;         // 500 kilómetros
$parrilla= [];            // Array de coches con 5 coches

// Creo 5 coches
$parrilla [0] = new Coche ("Ferrari",300);
$parrilla [1] = new Coche ("600",100);
$parrilla [2] = new Coche ("BMW",220);
$parrilla [3] = new Coche ("Seat",150);
$parrilla [4] = new Coche ("La Cabra",10);

// Test de pruebas todos deben generar errores

$c1 = $parrilla[0];
$c2 = $parrilla[1];
$c1->acelera(10);
$c2->frena(20);
$c1->parar();
$c2->recorre();

// Arranquen los motores
for ($i=0; $i< count($parrilla); $i++){
    $parrilla[$i]->arrancar();
}

// Comienza la carrera !!!!
do {
    for ($i = 0; $i < count($parrilla); $i++) {
        $parrilla[$i]->acelera(random_int(0, 20));
        $parrilla[$i]->recorre();
        $parrilla[$i]->frena(random_int(0,10));
        echo " <br> ".$parrilla[$i]->info();
    }
    
} while ( ! alcanzarMeta ( $parrilla, META) );


// Ordena la tabla para mostrar la clasificación
ordenarClasificacion ( $parrilla);

// Muestra la clasificación
for($i=0; $i< count($parrilla); $i++){
    echo ($i+1)."º Clasificado ". $parrilla[$i]->info()."<br>";
}

// MÉTODOS AUXILIARES
// Devuelve verdadero si hay algun coche que haya recorrido la distancia indicada.

function alcanzarMeta ( array $tcoches, int $distancia):bool{
   
   return true;
}

// Ordeno la tabla de objetos por los kilometros recorridos
function ordenarClasificacion ( array $tcoches):void{
    
}
?>