<?php
require_once __DIR__ . '/app/modelo/Conexion.php';
/* MODELO 3 - PEDIDO DE MATERIAL (SOLUCIÓN COMPLETA)
 * ENUNCIADO: Validar empleado y material, comprobar límite, registrar pedido
 * y descontar precio. Las dos escrituras se confirman como una operación.
 * Empleado y Material son clases entidad: sus atributos guardan columnas de
 * sus tablas. AccesoDatos separa el SQL de la parte que recibe el formulario.
 * __get/__set son métodos mágicos llamados automáticamente cuando se accede
 * a una propiedad privada desde fuera del objeto. */
class Empleado
{
    private $codigo, $nombre, $clave, $limite;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
class Material
{
    private $codigo, $nombre, $precio;
    public function __get($n)
    {
        return property_exists($this, $n) ? $this->$n : null;
    }
    public function __set($n, $v)
    {
        if (property_exists($this, $n)) $this->$n = $v;
    }
}
class AccesoDatos
{
    private static $modelo = null;
    private $dbh;
    public static function getModelo()
    {
        if (self::$modelo === null) self::$modelo = new self();
        return self::$modelo;
    }
    private function __construct()
    {
        $this->dbh = conectarModelo03();
    }
    public function empleado($c, $k)
    {
        $s = $this->dbh->prepare('SELECT * FROM empleados WHERE codigo=:c AND clave=:k');
        $s->execute([':c' => $c, ':k' => $k]);
        $s->setFetchMode(PDO::FETCH_CLASS, 'Empleado');
        return $s->fetch() ?: null;
    }
    public function material($c)
    {
        $s = $this->dbh->prepare('SELECT * FROM materiales WHERE codigo=:c');
        $s->execute([':c' => $c]);
        $s->setFetchMode(PDO::FETCH_CLASS, 'Material');
        return $s->fetch() ?: null;
    }
    public function comprar($e, $m)
    {
        $this->dbh->beginTransaction();
        try {
            $s = $this->dbh->prepare('UPDATE empleados SET limite=limite-:p WHERE codigo=:c AND limite>=:p');
            $s->execute([':p' => $m->precio, ':c' => $e->codigo]);
            if ($s->rowCount() !== 1) throw new Exception('Límite insuficiente.');
            $s = $this->dbh->prepare('INSERT INTO pedidos(codigo_empleado,codigo_material,precio) VALUES(:e,:m,:p)');
            $s->execute([':e' => $e->codigo, ':m' => $m->codigo, ':p' => $m->precio]);
            $this->dbh->commit();
        } catch (Throwable $x) {
            if ($this->dbh->inTransaction()) $this->dbh->rollBack();
            throw $x;
        }
    }
}
$c = $_POST['empleado'] ?? '';
$k = $_POST['clave'] ?? '';
$mc = $_POST['material'] ?? '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<form method="post"><input name="empleado"><input name="clave"><input name="material"><button>Comprar</button></form>';
    exit;
}
$db = AccesoDatos::getModelo();
$e = $db->empleado($c, $k);
if (!$e) die('Empleado no válido.');
$m = $db->material($mc);
if (!$m) die('Material no encontrado.');
try {
    $db->comprar($e, $m);
    echo 'Pedido realizado para ' . htmlspecialchars($e->nombre);
} catch (Throwable $x) {
    echo htmlspecialchars($x->getMessage());
}
