<?php
// Entidad del CRUD: cada atributo privado representa una columna de Usuarios.


class Usuario
{
    private $nombre;
    private $login;
    private $password;
    private $comentario;
    // NUEVO (requisito del examen): campos añadidos a la entidad de la base de datos.
    private $bloqueo;
    private $saldo;
    
    // __get se ejecuta automáticamente al leer $user->nombre desde una vista.
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }
    // __set se ejecuta al asignar $user->nombre = 'Ana'.
    public function __set($atributo,$valor){
        if(property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
    
}

