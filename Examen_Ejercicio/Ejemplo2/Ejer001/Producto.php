<?php

class Producto{

private $producto_no;
private $descripcion;
private $precio_actual;
private $stock_disponible;

    public function __get(string $name){
        if(property_exists($this,$name)){
            return $this->$name;
        }else{
            return "Atributo ERROR";
        }
    }

    public function __set(string $name, $value){
        if(property_exists($this,$name)){
            $this->$name = $value;
        }
    }
}

?>