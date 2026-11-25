<?php
// Entidad de catálogo: cada propiedad corresponde a una columna de productos.
class ProductoModelo
{
    private $id, $nombre, $categoria, $precio;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
