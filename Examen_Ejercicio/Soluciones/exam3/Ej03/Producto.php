<?php
// Entidad Producto: representa una fila de la tabla productos.
class Producto
{
    private $cod_pro;   
    private $nombre_pro;   
    private $precio;
    
    // strtolower normaliza el nombre recibido antes de buscar la propiedad.
    public function __set($nombre,$valor){
        $class = get_class($this);
        $nombre= strtolower($nombre); // Campo esta en mayusculas
        if ( property_exists($class, $nombre)){
            $this->$nombre = $valor; // Ojo $nombre
        }
    }
    
    // __get permite expresiones como $producto->precio.
    public function __get($nombre){
        $class = get_class($this);
        $nombre= strtolower($nombre);
        if ( property_exists($class, $nombre)){
            return  $this->$nombre;
        }
    }
}

