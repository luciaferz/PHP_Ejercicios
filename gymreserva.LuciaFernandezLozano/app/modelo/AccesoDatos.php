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
            $dsn = "mysql:host=10.10.8.10;dbname=gestionfitness;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }
    // Construyo la consulta

    // Busca al socio por sus credenciales y devuelve un Socio o null.
    public function obtenerSocio(string $codigo)
    {
        $resu = null;

        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM Socio
             WHERE $codigo_socio = :$codigo'
        );

        $stmt->bindValue(':codigo', $codigo);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Socio');

        if ($stmt->execute()) {
            $cliente = $stmt->fetch();
            if ($codigo !== false) {
                $resu = $codigo;
            }
        }

        return $resu;
    }

    // Devuelve un array de objetos Clase con plazas suficientes.
    public function obtenerClase(string $actividad, int $codigo_clase): array
    {
        $resu = [];
        $stmt = $this->dbh->prepare("select * from Clase where codigo_clase >= :codigo_clase");
        $stmt->bindValue(":codigo_clase", $codigo_clase);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Clase');
        if ($stmt->execute()) {
            $resu = $stmt->fetchAll();
        }
        return $resu;
    }

    public function actualizarPlazas($codigo, $plazas)
    {
        $stmt = $this->dbh->prepare("UPDATE Clase SET plazas_libres = plazas_libres - :plazas WHERE codigo_clase := codigo_clase AND plazas_libres >= plazas_libres");


        $stmt->execute([':codigo_socio' => $codigo,':plazas_libres' => $plazas]);

        return $stmt->rowCount() > 0;;
    }

    public function incrementarAsistencia($codigo)
    {
        $stmt = $this->dbh->prepare("UPDATE Socio SET contador_asistencias = contador_asistencias + 1 WHERE  codigo_socio =: codigo_socio");

        $stmt->execute([':codigo_socio' => $codigo]);

        return $ $stmt->rowCount() > 0;
    }
}
