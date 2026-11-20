<?php

class Producto{

private $producto_no;
private $descripcion;
private $precio_actual;
private $stock_disponible;

    // Permite leer las propiedades privadas usando, por ejemplo, $producto->precio_actual.
    public function __get(string $name){
        if(property_exists($this,$name)){
            return $this->$name;
        }else{
            return "Atributo ERROR";
        }
    }

    // Permite asignar valores a las propiedades privadas existentes.
    public function __set(string $name, $value){
        if(property_exists($this,$name)){
            $this->$name = $value;
        }
    }
}

?>