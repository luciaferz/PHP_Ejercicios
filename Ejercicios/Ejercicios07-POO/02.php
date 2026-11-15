<?php
class Reloj{
   
    private int $segundos;
    private int $formato24;
    private int $horaAlarma;

    function __construct($hora, $minutos, $segundos)
    {
        $this->$hora = (int)$hora;
        $this->$minutos = (int)$minutos;
        $this->$segundos = (int)$segundos;
    }

    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso
    function mostrarHora(){

    return "";
    }

    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    function formato24(bool $formato24){

    }

    // Incrementa en un segundo el valor de reloj
    function tictat(){

    }

    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia
    function compararHora(Reloj $otroreloj){

        return 0;
    }

    /*Si en el método tictac llegamos a la hora de alarma mostraremos un mensaje por pantalla indicando 
    que la alarma a la hora indicada está sonando. */

    //Permita fijar alarma   a una hora y minutos determinada
    function fijarAlarma(){

    }

    //Permita activar o desactivar la alarma en función de un valor lógico.
    function activarDesactivar(){

    }
}

?>