<?php
require_once __DIR__ . '/app/modelo/Conexion.php';
/*
 * MODELO 1 - AGENCIA DE TRENES (SOLUCIÓN COMPLETA)
 * ENUNCIADO: Buscar trenes por destino y entre 1 y 5 plazas. Validar GET,
 * consultar PDO, mostrar plazas suficientes y contar búsquedas con cookie.
 * Se practican clase entidad, Singleton, consulta preparada y FETCH_CLASS.
 */
class Tren
{
    // Estas propiedades representan las columnas de la tabla.
    private $codigo, $destino, $compania, $precio, $plazas_libres;
    // PDO usa __set al convertir una fila en objeto, aunque sean privadas.
    public function __set($nombre, $valor)
    {
        if (property_exists($this, $nombre)) $this->$nombre = $valor;
    }
    public function __get($nombre)
    {
        return property_exists($this, $nombre) ? $this->$nombre : null;
    }
}
class AccesoDatos
{
    // self::$modelo pertenece a la clase y guarda el único objeto Singleton.
    private static $modelo = null;
    private $dbh;
    public static function getModelo()
    {
        if (self::$modelo === null) self::$modelo = new self();
        return self::$modelo;
    }
    private function __construct()
    {
        try {
            $this->dbh = conectarModelo01();
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
    public function buscar($destino, $plazas)
    {
        // Los marcadores protegen de inyección SQL; nunca concatenamos GET.
        $s = $this->dbh->prepare('SELECT * FROM trenes WHERE destino=:destino AND plazas_libres>=:plazas ORDER BY precio');
        $s->bindValue(':destino', $destino);
        $s->bindValue(':plazas', $plazas, PDO::PARAM_INT);
        $s->execute();
        // FETCH_CLASS crea un Tren por cada fila, no un array asociativo.
        $s->setFetchMode(PDO::FETCH_CLASS, 'Tren');
        return $s->fetchAll();
    }
}
$destino = trim($_GET['destino'] ?? '');
$plazas = $_GET['plazas'] ?? '';
if ($destino === '' && $plazas === '') {
    echo '<form><input name="destino" required placeholder="Destino"><input name="plazas" type="number" min="1" max="5" required><button>Buscar</button></form>';
    exit;
}
if (!filter_var($plazas, FILTER_VALIDATE_INT) || $plazas < 1 || $plazas > 5) die('Las plazas deben estar entre 1 y 5.');
$trenes = AccesoDatos::getModelo()->buscar($destino, (int)$plazas);
if (!$trenes) die('No hay trenes disponibles.');
$consultas = (int)($_COOKIE['consultas_trenes'] ?? 0) + 1;
    // 604800 = 7*24*60*60: la cookie dura una semana.
    setcookie('consultas_trenes', $consultas, time() + 7*24*60*60, '/');
echo '<h1>Trenes</h1><p>Búsqueda ' . $consultas . '</p>';
foreach ($trenes as $t) echo '<p>' . htmlspecialchars($t->codigo) . ' - ' . htmlspecialchars($t->compania) . ' - ' . $t->precio . ' €</p>';
