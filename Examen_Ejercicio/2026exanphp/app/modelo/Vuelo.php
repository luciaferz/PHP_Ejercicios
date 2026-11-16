<?php

class Vuelo{
    private string $cod_vuelo;
    private string $destino;
    private string $aerolinea;
    private int $clase;
    private float $precio_billete;
    private int $asientos_libres;

    public function __construct(string $cod_vuelo, string $destino, string $aerolinea, int $clase, float $precio_billete, int $asientos_libres) {
        $this->cod_vuelo = $cod_vuelo;
        $this->destino = $destino;
        $this->aerolinea = $aerolinea;
        $this->clase = $clase;
        $this->precio_billete = $precio_billete;
        $this->asientos_libres = $asientos_libres;
    }

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
        }
    }
}
