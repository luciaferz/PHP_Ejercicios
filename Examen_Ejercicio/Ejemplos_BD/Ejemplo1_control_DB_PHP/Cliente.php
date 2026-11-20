<?php
Class Cliente{
    private $cod_cliente;
    private $nombre;
    private $clave;
    private $veces;

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