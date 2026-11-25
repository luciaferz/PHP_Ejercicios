<?php
// Entidad cuyas propiedades coinciden con las columnas que devuelve el JOIN.
class Pedido
{
    private $id, $cliente, $producto, $importe, $estado;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
