<?php
/*
 * Acceso a datos con BD Usuarios y Patrón Singleton.
 * El código original de Usuarios se conserva y se añade debajo
 * el acceso a la tabla Productos.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Usuario.php';

class AccesoDatos
{
    /* Patrón Singleton: mantiene una única conexión PDO durante la petición. */
    private static $modelo = null;
    private $dbh;

    //Conexion con BD de Productos
    private function __construct()
    {
        $dsn = 'mysql:host=' . SERVER_DB . ';dbname=' . DATABASE_PRODUCTOS . ';charset=utf8';
        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
    public static function getModelo()
    {
        if (self::$modelo === null) self::$modelo = new self();
        return self::$modelo;
    }
    public static function closeModelo()
    {
        self::$modelo = null;
    }

    /* ================================================================
       CRUD ORIGINAL DE USUARIOS
       ================================================================ */
    public function getUsuarios(): array
    {
        $stmt = $this->dbh->query('SELECT * FROM Usuarios');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        return $stmt->fetchAll();
    }

    public function getUsuario(string $login)
    {
        $stmt = $this->dbh->prepare('SELECT * FROM Usuarios WHERE login=:login');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $stmt->execute([':login' => $login]);
        return $stmt->fetch();
    }

    public function addUsuario($usuario): bool
    {
        $stmt = $this->dbh->prepare('INSERT INTO Usuarios (login,nombre,password,comentario) VALUES (?,?,?,?)');
        return $stmt->execute([$usuario->login, $usuario->nombre, $usuario->password, $usuario->comentario]);
    }

    public function modUsuario($usuario): bool
    {
        $stmt = $this->dbh->prepare('UPDATE Usuarios SET nombre=:nombre,password=:password,comentario=:comentario WHERE login=:login');
        return $stmt->execute([':login'=>$usuario->login, ':nombre'=>$usuario->nombre, ':password'=>$usuario->password, ':comentario'=>$usuario->comentario]);
    }

    public function borrarUsuario(string $login): bool
    {
        $stmt = $this->dbh->prepare('DELETE FROM Usuarios WHERE login=:login');
        return $stmt->execute([':login' => $login]);
    }

    // ---------------- MÉTODOS DEL CRUD DE PRODUCTOS ----------------

    public function getProductos(): array
    {
        return $this->dbh->query('SELECT codigo,nombre,stock,stock_min,precio FROM Productos ORDER BY codigo')->fetchAll(PDO::FETCH_ASSOC);
    }

    // Devuelve un producto por su código.
    public function getProducto(int $codigo)
    {
        $stmt = $this->dbh->prepare('SELECT codigo,nombre,stock,stock_min,precio FROM Productos WHERE codigo=:codigo');
        $stmt->execute([':codigo' => $codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserta un producto nuevo.
    public function addProducto(array $p): bool
    {
        $stmt = $this->dbh->prepare('INSERT INTO Productos (codigo,nombre,stock,stock_min,precio) VALUES (:codigo,:nombre,:stock,:stock_min,:precio)');
        return $stmt->execute($p);
    }

    // Modifica un producto usando el código original como referencia.
    public function modProducto(array $p, int $codigoOriginal): bool
    {
        $stmt = $this->dbh->prepare('UPDATE Productos SET codigo=:codigo,nombre=:nombre,stock=:stock,stock_min=:stock_min,precio=:precio WHERE codigo=:codigoOriginal');
        $p['codigoOriginal'] = $codigoOriginal;
        return $stmt->execute($p);
    }

    // Elimina un producto por su código.
    public function borrarProducto(int $codigo): bool
    {
        $stmt = $this->dbh->prepare('DELETE FROM Productos WHERE codigo=:codigo');
        return $stmt->execute([':codigo' => $codigo]);
    }
}
