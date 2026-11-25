<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos
{

    private static $modelo = null;
    private $dbh = null;
    private $stmt_usuarios = null;
    private $stmt_usuario  = null;
    private $stmt_boruser  = null;
    private $stmt_moduser  = null;
    private $stmt_creauser = null;
    // NUEVO (requisito del examen): consultas para actualizar saldo y bloqueo.
    private $stmt_updateSaldo = null;
    private $stmt_updateBloqueo = null;

    // Devuelve el objeto único de acceso a datos; lo crea la primera vez y después lo reutiliza.
    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado  Patron singleton

    private function __construct()
    {

        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=usuariosctl;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        $this->stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $this->stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =:login");
        $this->stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        // NUEVO (requisito del examen): consulta que multiplica el saldo por 1.10, es decir, suma un 10 %.
        $this->stmt_updateSaldo = $this->dbh->prepare("update Usuarios set saldo=saldo*1.10 where login=:login");
        $this->stmt_updateBloqueo = $this->dbh->prepare("update Usuarios set bloqueo=:bloqueo where login=:login");
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    // Libera la conexión y borra la instancia única al terminar la aplicación.
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            $obj->stmt_usuarios = null;
            $obj->stmt_usuario  = null;
            $obj->stmt_boruser  = null;
            $obj->stmt_moduser  = null;
            $obj->stmt_creauser = null;
            $obj->stmt_updateSaldo = null;
            $obj->stmt_updateBloqueo = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Usuarios
    public function getUsuarios(): array
    {
        $tuser = [];
        $this->stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Usuario');

        if ($this->stmt_usuarios->execute()) {
            while ($user = $this->stmt_usuarios->fetch()) {
                $tuser[] = $user;
            }
        }
        return $tuser;
    }

    // Devuelvo un usuario o false
    public function getUsuario(String $login)
    {
        $user = false;

        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $this->stmt_usuario->bindParam(':login', $login);
        if ($this->stmt_usuario->execute()) {
            if ($obj = $this->stmt_usuario->fetch()) {
                $user = $obj;
            }
        }
        return $user;
    }

    // UPDATE
    public function modUsuario($user): bool
    {

        $this->stmt_moduser->bindValue(':login', $user->login);
        $this->stmt_moduser->bindValue(':nombre', $user->nombre);
        $this->stmt_moduser->bindValue(':password', $user->password);
        $this->stmt_moduser->bindValue(':comentario', $user->comentario);
        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount() == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user): bool
    {

        $this->stmt_creauser->execute([$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($this->stmt_creauser->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login): bool
    {
        $this->stmt_boruser->bindValue(':login', $login);
        $this->stmt_boruser->execute();
        $resu = ($this->stmt_boruser->rowCount() == 1);
        return $resu;
    }

    // NUEVO (requisito del examen): aumenta un 10 % el saldo de cada login seleccionado.
    public function actualizarSaldos(array $logins)
    {
        foreach ($logins as $login) {
            $this->stmt_updateSaldo->bindValue(':login', $login);
            $this->stmt_updateSaldo->execute();
        }
    }

    // NUEVO (requisito del examen): marca como bloqueados los seleccionados y desbloquea los demás.
    public function actualizarBloqueos(array $logins)
    {
        $usuarios = $this->getUsuarios();

        foreach ($usuarios as $user) {
            $loginSeleccionado = in_array($user->login, $logins, true);
            $bloqueoNuevo = $loginSeleccionado ? 1 : 0;

            // Solo escribe en la base de datos si el bloqueo realmente cambia.
            if ((int) $user->bloqueo !== $bloqueoNuevo) {
                $this->stmt_updateBloqueo->bindValue(':login', $user->login);
                $this->stmt_updateBloqueo->bindValue(':bloqueo', $bloqueoNuevo);
                $this->stmt_updateBloqueo->execute();
            }
        }
    }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
