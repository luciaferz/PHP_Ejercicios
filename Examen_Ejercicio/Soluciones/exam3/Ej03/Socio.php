<?php
// Entidad Socio: sus propiedades privadas corresponden a columnas SQL.
class Socio
{
    private $cod_socio;
    private $nombre;
    private $clave;
    private $cantidad_max;
    // __set permite hidratar el objeto y __get permite leerlo desde la vista.
    
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

