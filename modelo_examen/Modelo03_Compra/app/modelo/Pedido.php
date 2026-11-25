<?php
// Representa el pedido que se inserta después de validar empleado y material.
class PedidoModelo{private $id,$codigo_empleado,$codigo_material,$precio;public function __get($n){return property_exists($this,$n)?$this->$n:null;}public function __set($n,$v){if(property_exists($this,$n))$this->$n=$v;}}
