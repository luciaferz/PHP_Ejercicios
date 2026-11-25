<?php
// La clase Vuelo es necesaria para que FETCH_CLASS pueda crear objetos.
require_once "Vuelo.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    // Método estático: se llama con AccesoDatos::initModelo(), sin crear antes objeto.
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    
    private function __construct(){
        // Constructor privado: Singleton controla que exista una sola conexión.
        // Cambiar le password !!!!!
        try {
            $dsn = "mysql:host=localhost;dbname=airflyDB;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
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

    // Solo comprueba existencia y devuelve true/false, no necesita listar todo.
    public function hayVuelos (string $destino):bool{
        $resu = false;
        $stmt = $this->dbh->prepare("select * from Vuelos where destino =:destino limit 1");
        // bindValue sustituye el marcador por el valor sin concatenarlo al SQL.
        $stmt->bindValue(":destino",$destino);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Vuelo');
        if ( $stmt->execute()) {
            if ( $stmt->fetch()){
                $resu = true;
            }
        }
        return $resu;
    }

    // Devuelve un array de objetos Vuelo con plazas suficientes.
    public function getVuelos(string $destino, int $plazas):array{
        $resu = [];
        $stmt = $this->dbh->prepare("select * from Vuelos where destino =:destino and asientos_libres >= :plazas");
        $stmt->bindValue(":destino",$destino);
        $stmt->bindValue(":plazas" ,$plazas);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Vuelo');
        if ( $stmt->execute()) {
            $resu = $stmt->fetchAll();    
        }
        return $resu;  
    }


  
}

