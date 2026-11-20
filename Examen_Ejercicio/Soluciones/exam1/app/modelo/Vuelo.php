<?php

class Vuelo {
   private string $cod_vuelo;
   private string $destino;

   private  string $aerolinea;
   private int $clase;
   private  float $precio_billete;
   private int $asientos_libres;

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
