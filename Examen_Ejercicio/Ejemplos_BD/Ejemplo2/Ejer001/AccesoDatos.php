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
            $dsn = "mysql:host=localhost;dbname=Almacendb;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
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

// Recupera los productos con stock superior a 10 para mostrarlos en la tabla.
public function getStock(): array{
        $stmt = $this->dbh->prepare(
            'SELECT producto_no, descripcion, precio_actual, stock_disponible
             FROM productos
             WHERE stock_disponible > :limite');

        // Asigna al marcador :limite el valor usado para filtrar el stock.
        $stmt->bindValue(':limite', 10, PDO::PARAM_INT);
        // Cada fila obtenida se convierte en un objeto Producto.
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $stmt->execute();

        return $stmt->fetchAll();
}

/**3) El usuario marcará los productos que quiera y pulsará botón ‘Actualizar’ que reducirá en un 10 % el precio de los artículo marcados. 
 * Mostrando de nuevo la lista con los productos con sus precios actualizados. */
// Aplica el descuento a los productos seleccionados y devuelve las filas actualizadas.
public function actualizarPrecios(array $productos): int{
        $stmt = $this->dbh->prepare(
            'UPDATE productos
             SET precio_actual = precio_actual * 0.90
             WHERE producto_no = :producto_no
               AND stock_disponible > 10');

        $filasActualizadas = 0;

        // Ejecuta la actualización una vez por cada número de producto seleccionado.
        foreach ($productos as $productoNo) {
            $stmt->execute([':producto_no' => $productoNo]);
            $filasActualizadas += $stmt->rowCount();
        }

        return $filasActualizadas;
}

}

?>