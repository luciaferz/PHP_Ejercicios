<?php


class Usuario
{
    private $nombre;
    private $login;
    private $password;
    private $comentario;
    // NUEVO (requisito del examen): datos añadidos a la entidad de la base de datos.
    private $saldo;
    private $bloqueo;
    
    // Getter con método mágico
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // Setter con método mágico
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
    
}

