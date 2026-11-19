<?php

include_once __DIR__ . '/Producto.php';

class AccesoDatos{

 // Guarda la única instancia del modelo (patrón Singleton).
    private static $modelo = null;
    private $dbh = null;

    // Devuelve el modelo existente o crea uno la primera vez.
    public static function initModelo(){
        // Crea una sola instancia de AccesoDatos y la reutiliza en llamadas posteriores.
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // El constructor privado obliga a crear el modelo mediante initModelo().
     private function __construct(){
        // Abre la conexión PDO con la base de datos.
        try {
            $dsn = "mysql:host=10.10.8.10;dbname=etienda;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

/**2) La aplicación permitirá rebajar el precio de los productos con un stock actual superior a 10, 
 * mostrando en una tabla la productos que cumplen esta condición. 
 * Con un checkbox donde se puede seleccionar un producto.
 */

function stockSuperior($stock_disponible, $producto_no): array{
     $resu = null;

        $stmt = $this->dbh->prepare(
            'SELECT producto_no, stock_disponible
             FROM Producto
             WHERE producto_no = :producto_no AND stock_disponible >10');

        $stmt->bindValue(':producto_no', $producto_no);
        $stmt->bindValue(':stock_disponible', $stock_disponible);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');

        if ($stmt->execute()) {
            $cliente = $stmt->fetchAll();
            if ($cliente !== false) {
                $resu = $cliente;
            }
        }

        return $resu;
    }

}



/**3) El usuario marcará los productos que quiera y pulsará botón ‘Actualizar’ que reducirá en un 10 % el precio de los artículo marcados. 
 * Mostrando de nuevo la lista con los productos con sus precios actualizados. */


/**4) Esta operación de actualización solo se podrá realizar una vez en el mismo día desde un mismo navegador, 
 * la consulta siempre se puede repetir. Para ello se controlará el acceso mediante un cookie que guarda la fecha 
 * cuando se ha realizado la última actualización.  Nota: Este método se puede saltar fácilmente, bastaría con borrar 
 * los cookies del navegador o abrir una pestaña privada.

	Si el usuario intenta esta operación la aplicación debe mostrar un mensaje de error.
 */

}

?>