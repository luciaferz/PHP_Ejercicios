<?php

class Vuelo{
    //Para recuperar de la base de datos
    private string $cod_vuelo;
    private string $destino;
    private string $aerolinia;
    private int $clase;
    private float $precio_billete;
    private int $asientos_libres;

    public function __get(string $name){
        if(property_exists($this,$name)){
            return $this->$name;
        }else{
            return "Atributo error";
        }
        
    }

    public function __set(string $name, $value){
        if(property_exists($this,$name)){
            $this->$name = $value;
        }else{

        }
    }

    //Funcion a llamar 
    function getsVuelos($destino) : array{

    }
}
