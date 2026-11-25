<?php
// Entidad: sus atributos privados corresponden a las columnas de Vuelos.

class Vuelo {
   private string $cod_vuelo;
   private string $destino;

   private  string $aerolinea;
   private int $clase;
   private  float $precio_billete;
   private int $asientos_libres;

   // __get se ejecuta automáticamente al leer $vuelo->destino desde una vista.
   public function __get(string $name){
       if ( property_exists($this,$name)){
         return $this->$name;
       } else {
         return " ERROR ATRIBUTO ";
       }
   }

   // __set se ejecuta al hidratar el objeto con PDO::FETCH_CLASS.
   public function __set($name, $value){
       if ( property_exists($this,$name)){
         $this->$name = $value;
       } else {
         throw new Exception(" SET error de atributo");
       }
   }
}
