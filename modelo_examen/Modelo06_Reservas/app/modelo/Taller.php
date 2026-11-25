<?php
// Entidad de talleres: el atributo plazas controla si se permite reservar.
class TallerModelo
{
    private $id, $nombre, $plazas;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
