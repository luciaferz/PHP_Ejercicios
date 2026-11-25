<?php
require_once __DIR__ . '/Pedido.php';
class AccesoDatos
{
    // Esta clase concentra las consultas. El controlador solo pide datos y la
    // vista solo los muestra: así cada archivo tiene una responsabilidad clara.
    private static $modelo = null;
    private $dbh;
    public static function getModelo()
    {
        if (self::$modelo === null) self::$modelo = new self();
        return self::$modelo;
    }
    private function __construct()
    {
        // El constructor privado obliga a reutilizar la conexión mediante
        // getModelo(), que es la idea del patrón Singleton.
        $this->dbh = new PDO('mysql:host=localhost;dbname=modelo_pedidos;charset=utf8', 'root', 'root');
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function pedidos($cliente)
    {
        // JOIN relaciona dos tablas y devuelve columnas de clientes y pedidos.
        $sql = 'SELECT p.id,c.nombre AS cliente,p.producto,p.importe,p.estado FROM pedidos p JOIN clientes c ON c.id=p.cliente_id';
        $params = [];
        if ($cliente !== '') {
            $sql .= ' WHERE c.nombre LIKE :cliente';
            $params[':cliente'] = '%' . $cliente . '%';
        }
        $sql .= ' ORDER BY p.id DESC';
        // prepare() evita insertar directamente en el SQL el texto del usuario.
        $s = $this->dbh->prepare($sql);
        $s->execute($params);
        $s->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        return $s->fetchAll();
    }
}
