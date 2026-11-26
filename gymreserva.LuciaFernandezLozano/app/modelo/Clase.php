<?php
class Clase {
 
private $codigo_clase;
private $actividad;
private $instalacion;
private $precio_sesion;
private $plazas_libres;

   public function __get(string $name){
       if ( property_exists($this,$name)){
         return $this->$name;
       } else {
         return " ERROR ATRIBUTO ";
       }
   }

   public function __set($name, $value){
       if ( property_exists($this,$name)){
         $this->$name = $value;
       } else {
         throw new Exception(" SET error de atributo");
       }
   }

}
