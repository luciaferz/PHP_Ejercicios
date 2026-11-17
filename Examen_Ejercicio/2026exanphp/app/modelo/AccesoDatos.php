<?php
require_once "Vuelo.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        // Crea una sola instancia de AccesoDatos y la reutiliza en llamadas posteriores.
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    
    private function __construct(){
        // Abre la conexión PDO con la base de datos.
        try {
            $dsn = "mysql:host=localhost;dbname=Vuelos;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }


    public function getVuelos(string $destino, int $plazas): array
    {
        // Busca vuelos al destino indicado que tengan plazas suficientes.
        $sql = "SELECT cod_vuelo, destino, aerolinea, clase, precio_billete, asientos_libres
                FROM Vuelos
                WHERE destino = :destino
                  AND asientos_libres >= :plazas
                ORDER BY precio_billete ASC;";

        // Prepara la consulta y pasa los valores aparte, sin concatenarlos en el SQL.
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([ //Recibe un array asociativo con los valores de los parámetros y ejecuta la consulta.
            'destino' => $destino,
            'plazas' => $plazas,
        ]);

        // Convierte cada fila obtenida en un objeto Vuelo.
        $vuelos = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vuelos[] = new Vuelo(
                $fila['cod_vuelo'],
                $fila['destino'],
                $fila['aerolinea'],
                (int) $fila['clase'],
                (float) $fila['precio_billete'],
                (int) $fila['asientos_libres']
            );
        }

        // Devuelve todos los vuelos encontrados o un array vacío si no hay resultados.
        return $vuelos;
    }

    public function existeDestino(string $destino): bool
    {
        // Comprueba si hay al menos un vuelo para el destino, independientemente de las plazas.
        $sql = "SELECT 1 FROM Vuelos WHERE destino = :destino LIMIT 1";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['destino' => $destino]);

        // fetchColumn devuelve false cuando la consulta no encuentra ninguna fila.
        return $stmt->fetchColumn() !== false;
    }
  
//--------Version profesor----------------
    public function hayVUelos($destino): bool{
        $resu = false;

        $stmt = $this->dbh->prepare("SELECT * FROM Vuelos WHERE destino = :destino limit 1");
        $stmt->bindValue(":destino", $destino);
        $stmt->setFetchMOde(PDO::FETCH_CLASS);

        if($stmt->execute()){
            if($stmt->fetch()){
                $resu = true;
            }
        }
        return $resu;
    }
}

public function getVuelos2 (string $destino, int $plazas): array {
    $tresu = [];

     $stmt = $this->dbh->prepare("SELECT * FROM Vuelos WHERE destino = :destino AND asientos_libres >= plaza");
        $stmt->bindValue(":destino", $destino);
        $stmt->bindValue(":asientos_libres", $plaza);
        $stmt->setFetchMOde(PDO::FETCH_CLASS);

        if($stmt->execute()){
            $tresu = stmt->fetchAll();
        }
        
    return $tresu;
}
