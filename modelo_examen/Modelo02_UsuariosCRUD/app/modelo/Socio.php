<?php
// Entidad alternativa separada: sus nombres deben coincidir con columnas SQL.
class SocioModelo
{
    private $login, $nombre, $password, $comentario, $saldo, $bloqueo;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
