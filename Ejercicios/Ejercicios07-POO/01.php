<?php
/*Se desea implementar una clase denominada CuentaBancaria que codifique el funcionamiento básico de una cuenta bancaria. 
Para ello se definen los siguientes atributos y métodos

Atributos: Todos privados
 Métodos de instancia: el saldo de la cuenta y el número de movimientos realizados.
 Métodos de clase (static): número de cuentas bancarias creadas.   

Métodos:
1)  Tiene un constructor  donde se indica el saldo inicial de la cuenta o sin no se indica nada se inicia la cuenta con saldo igual a 0

2) Ingreso, incrementa el saldo en una cantidad indicada como parámetro.

3) Abono, decremento el saldo en la cantidad indicada como parámetro.

4) Anotar gastos decrementa el saldo en 20 euros si el saldo de la cuenta es menor 1000

5)Anotar Intereses incrementa la cuenta según valor de interés indicado como parámetro en tanto por ciento.    

6) Realizar transferencia a cuenta, decrementa el saldo en la cantidad indicada como parámetro, realizando un ingreso en la cuenta destino.

7) Consultar estado de la cuenta, mostrá el saldo actual y el número de operaciones realizadas

Se supone que siempre se pueden hacer la operaciones aunque suponga que la cuenta se queda en números rojos. Todos los métodos salvo el consultar saldo incrementa el número de operaciones
*/

/*Prueba de CuentaBancaria */
include_once 'CuentaBancaria.php';
echo "<h2> PROBANDO </H2>";

$c1 = new CuentaBancaria(100);
$c2 = new CuentaBancaria(1900);
$c3 = new CuentaBancaria();

$c1->abono(20);
$c1->ingreso(10);
$c1->anotarGastos();
echo "<br> Cuenta c1 = ".$c1->consultarEstado();

$c2->ingreso(100);
$c2->anotarGastos(); // No se aplican pues su saldo es mayor que 1000
$c2->anotarIntereses(5); // 5% de interes
$c2->transferencia(100,$c3);
echo "<br> Cuenta c2 = ".$c2->consultarEstado();

$c3->abono(75);
$c3->abono(75);  // Se queda con saldo negativo
echo "<br> Cuenta c3 = ".$c3->consultarEstado();

class CuentaBancaria {
    // -------------------------------------
    // Atributos de Clase
    // -------------------------------------
    
    private $saldo;          // Saldo actual de la cuenta
    private $numMovimientos; // Número de movimientos realizados
    private static $numCuentas = 0; // Número de cuentas creadas
    
    // -------------------------------------
    //   METODOS:
    // -------------------------------------
    
    // Constructores
    public function __construct(int $saldo = 0){
        $this->saldo = $saldo;
        $this->numMovimientos = 0;
        //CuentaBancaria::$numCuentas++; // Otra forma menos general
        self::$numCuentas++;
    }
    
    //Ingreso, incrementa el saldo en una cantidad indicada como parámetro.
    public function ingreso (int $cantidad){
        $this->saldo += $cantidad;
        $this->numMovimientos++;
    }
    
    // Abono, decremento el saldo en la cantidad indicada como parámetro.
    public function abono (int $cantidad){
        
    }
    
    // Anotar gastos decrementa el saldo en 20 euros si
    // el saldo de la cuenta es menor 1000
    public function anotarGastos(){
        
    }
    
    // Anotar Intereses incrementa la cuenta según valor de interés indicado
    // como parámetro en tanto por ciento.
    public function anotarIntereses ( int $interes){
        
    }
    
    //Realizar transferencia a cuenta, decrementa el saldo
    // en la cantidad indicada
    // como parámetro, realizando un ingreso en la cuenta destino.
    public function transferencia ( int $importe, CuentaBancaria $destino){
        
    }
    
    // Consultar estado de la cuenta, mostrá el saldo actual y
    // el número de operaciones realizadas
    public function consultarEstado ():string{
        return " Saldo = ". $this->saldo .
                          " Nº operaciones = ". $this->numMovimientos;
    }
}

?>