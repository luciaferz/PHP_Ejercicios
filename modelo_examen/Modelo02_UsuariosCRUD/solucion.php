<?php
require_once __DIR__ . '/app/modelo/Conexion.php';
/*
 * MODELO 2 - ADMINISTRACIÓN DE SOCIOS (SOLUCIÓN COMPLETA)
 * ENUNCIADO: CRUD de socios con login, nombre, clave, comentario, saldo y
 * bloqueo. Añadir acciones masivas: subir 10% el saldo marcado y bloquear
 * los marcados, dejando desbloqueados los demás.
 */
class Socio
{
    private $login, $nombre, $password, $comentario, $saldo, $bloqueo;
    // Los métodos mágicos permiten leer propiedades privadas desde la vista.
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
        $this->dbh = conectarModelo02();
    }
    public function listar()
    {
        $s = $this->dbh->query('SELECT * FROM socios ORDER BY login');
        $s->setFetchMode(PDO::FETCH_CLASS, 'Socio');
        return $s->fetchAll();
    }
    public function insertar($u)
    {
        $s = $this->dbh->prepare('INSERT INTO socios(login,nombre,password,comentario,saldo,bloqueo) VALUES(:login,:nombre,:password,:comentario,:saldo,0)');
        return $s->execute([':login' => $u->login, ':nombre' => $u->nombre, ':password' => $u->password, ':comentario' => $u->comentario, ':saldo' => $u->saldo]);
    }
    public function modificar($u)
    {
        $s = $this->dbh->prepare('UPDATE socios SET nombre=:nombre,password=:password,comentario=:comentario WHERE login=:login');
        return $s->execute([':login' => $u->login, ':nombre' => $u->nombre, ':password' => $u->password, ':comentario' => $u->comentario]);
    }
    public function borrar($login)
    {
        $s = $this->dbh->prepare('DELETE FROM socios WHERE login=:login');
        $s->execute([':login' => $login]);
        return $s->rowCount() === 1;
    }
    public function acciones($saldos, $bloqueos)
    {
        // Reutilizar una consulta preparada dentro del foreach evita SQL inseguro.
        $s = $this->dbh->prepare('UPDATE socios SET saldo=saldo*1.10 WHERE login=:login');
        foreach ($saldos as $login) $s->execute([':login' => $login]);
        // Primero normalizamos todos y después aplicamos los checkboxes marcados.
        $this->dbh->exec('UPDATE socios SET bloqueo=0');
        $s = $this->dbh->prepare('UPDATE socios SET bloqueo=1 WHERE login=:login');
        foreach ($bloqueos as $login) $s->execute([':login' => $login]);
    }
}
$db = AccesoDatos::getModelo();
$accion = $_POST['accion'] ?? 'listar';
if ($accion === 'crear' || $accion === 'modificar') {
    $u = new Socio();
    $u->login = trim($_POST['login'] ?? '');
    $u->nombre = trim($_POST['nombre'] ?? '');
    $u->password = $_POST['password'] ?? '';
    $u->comentario = trim($_POST['comentario'] ?? '');
    $u->saldo = (float)($_POST['saldo'] ?? 0);
    if ($u->login === '' || $u->nombre === '') die('Faltan login y nombre.');
    $accion === 'crear' ? $db->insertar($u) : $db->modificar($u);
}
if ($accion === 'borrar') $db->borrar($_POST['login'] ?? '');
if ($accion === 'acciones') $db->acciones($_POST['saldo'] ?? [], $_POST['bloqueo'] ?? []);
$socios = $db->listar();
echo '<h1>Socios</h1><table border="1"><tr><th>Login</th><th>Nombre</th><th>Saldo</th><th>Bloqueo</th></tr>';
foreach ($socios as $u) echo '<tr><td>' . htmlspecialchars($u->login) . '</td><td>' . htmlspecialchars($u->nombre) . '</td><td>' . $u->saldo . '</td><td>' . ($u->bloqueo ? 'Sí' : 'No') . '</td></tr>';
echo '</table><form method="post"><input type="hidden" name="accion" value="acciones">';
foreach ($socios as $u) echo '<label>' . htmlspecialchars($u->login) . ' <input type="checkbox" name="saldo[]" value="' . $u->login . '"> +10% <input type="checkbox" name="bloqueo[]" value="' . $u->login . '"> bloquear</label><br>';
echo '<button>Aplicar acciones</button></form>';
