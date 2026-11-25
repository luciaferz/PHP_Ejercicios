<?php
/* Clase de acceso a datos: separa PDO y SQL del controlador de compra. */
include_once "Socio.php";
include_once 'Producto.php';

/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    // Singleton: todas las operaciones reutilizan la misma conexión.
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    // Creo un lista de alimentos, podría obtenerse de una base de datos
    private function __construct(){
        // Constructor privado: la conexión se obtiene con initModelo().
        
        try {
            $dsn = "mysql:host=localhost;dbname=comprasdb;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo la consulta
        
        
    }
    
    
    // SELECT con dos parámetros: código y clave deben coincidir.
    public function buscarSocio ($cod_socio, $clave) {
        $socio = null;
        $stmt = $this->dbh->prepare("select * from socios where cod_socio = ? and clave = ?");
        // Los ? se rellenan por posición; la primera posición es 1.
        $stmt->bindValue(1, $cod_socio);
        $stmt->bindValue(2, $clave);
        // Devuelvo una tabla de objetos
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Socio');
        if ( $stmt->execute() ){
            if ( $obj = $stmt->fetch()){
                $socio= $obj;
            }
        }
       return $socio;
    }
    
    // Aquí se usa un parámetro con nombre, equivalente a usar ?.
    public function  buscarProducto($cod_producto) {
        $producto = null;
        $stmt = $this->dbh->prepare("select * from productos where cod_pro = :cod_pro ");
        $stmt->bindValue(":cod_pro", $cod_producto);
        // Devuelvo una tabla de objetos
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if ( $stmt->execute() ){
            if ( $obj = $stmt->fetch()){
                $producto= $obj;
            }
        }
        return $producto;
    }
    
    // UPDATE descuenta el importe después de comprobar el límite.
    public function actualizarSocio($cod_socio,$importe):void {
        $stmt = $this->dbh->prepare("update socios set cantidad_max = cantidad_max - ?  where cod_socio = ? ");
        $stmt->bindValue(1, $importe);
        $stmt->bindValue(2, $cod_socio);
        $stmt->execute();
    }
    
     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
