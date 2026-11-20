<?php
class Socio
{
    private $cod_socio;
    private $nombre;
    private $clave;
    private $cantidad_max;
    // Métodos mágicos para setter y getter
    
    public function __set($nombre,$valor){
        $class = get_class($this);
        $nombre= strtolower($nombre); // Campo esta en mayusculas
        if ( property_exists($class, $nombre)){
            $this->$nombre = $valor; // Ojo $nombre
        }
    }
    
    public function __get($nombre){
        $class = get_class($this);
        $nombre= strtolower($nombre);
        if ( property_exists($class, $nombre)){
            return  $this->$nombre;
        }
    }
    
}

