<?php
class Hijo extends  Persona{

    private string $apellido;
    private string $nombre;

function __construct(string $nombre, string $apellido, int $edad){
    parent::__construct($nombre, $edad);
    $this->apellido = $apellido;
}

//class Hijo implements Primos 
//trait y use - clases que no tienen que ver con la herencia pero que se pueden usar en cualquier clase

?>