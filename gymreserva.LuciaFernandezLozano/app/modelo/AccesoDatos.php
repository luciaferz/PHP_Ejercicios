<?php
require_once "Clase.php";
require_once "Socio.php";

class AccesoDatos
{

    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;

    public static function initModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // CAMBIAR LA CONTRASEÑA
    private function __construct()
    {

        try {
            $dsn = "mysql:host=localhost;dbname=gestionfitness;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }
    // Construyo la consulta

    // Busca al socio por sus credenciales y devuelve un Socio o null.
    public function obtenerSocio(int $codigo): ?Socio
    {
        $resu = null;

        $stmt = $this->dbh->prepare('SELECT * FROM Socio WHERE codigo_socio = :codigo');

        $stmt->bindValue(':codigo', $codigo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Socio');

        if ($stmt->execute()) {
            $socio = $stmt->fetch();
            if ($socio !== false) $resu = $socio;
        }

        return $resu;
    }

    // Devuelve un array de objetos Clase con plazas suficientes.
    public function obtenerClase(string $actividad, int $plazas): ?Clase
    {
        $resu = null;
        $stmt = $this->dbh->prepare('SELECT * FROM Clase WHERE actividad = :actividad AND plazas_libres >= :plazas ORDER BY codigo_clase LIMIT 1');
        $stmt->bindValue(':actividad', $actividad);
        $stmt->bindValue(':plazas', $plazas, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Clase');
        if ($stmt->execute()) {
            $clase = $stmt->fetch();
            if ($clase !== false) $resu = $clase;
        }
        return $resu;
    }

    public function actualizarPlazas(int $codigo, int $plazas): bool
    {
        $stmt = $this->dbh->prepare('UPDATE Clase SET plazas_libres = plazas_libres - :plazas WHERE codigo_clase = :codigo AND plazas_libres >= :plazas');


        $stmt->execute([':codigo' => $codigo, ':plazas' => $plazas]);

        return $stmt->rowCount() > 0;;
    }

    public function incrementarAsistencia(int $codigo): bool
    {
        $stmt = $this->dbh->prepare('UPDATE Socio SET contador_asistencias = contador_asistencias + 1 WHERE codigo_socio = :codigo');

        $stmt->execute([':codigo' => $codigo]);

        return $stmt->rowCount() > 0;
    }
}
