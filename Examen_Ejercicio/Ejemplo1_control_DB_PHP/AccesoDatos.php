<?php
include_once __DIR__ . '/Cliente.php';
include_once __DIR__ . '/Pedido.php';

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
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

    // Busca al cliente por sus credenciales y devuelve un Cliente o null.
    public function getCliente(string $nombre, string $clave){
        $resu = null;

        $stmt = $this->dbh->prepare(
            'SELECT cod_cliente, nombre, clave, veces
             FROM clientes
             WHERE nombre = :nombre AND clave = :clave'
        );

        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':clave', $clave);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cliente');

        if ($stmt->execute()) {
            $cliente = $stmt->fetch();
            if ($cliente !== false) {
                $resu = $cliente;
            }
        }

        return $resu;
    }

    // Devuelve todos los pedidos asociados al código de un cliente.
    public function getPedidosClientes(int $codCliente): array{
        $stmt = $this->dbh->prepare(
            'SELECT numped, cod_cliente, producto, precio
                FROM pedidos
                WHERE cod_cliente = :cod_cliente
                ORDER BY numped'
        );

        $stmt->bindValue(':cod_cliente', $codCliente);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Suma una entrada al contador de accesos del cliente.
    public function incrementarAccesos(int $codCliente): bool{
        $stmt = $this->dbh->prepare(
            'UPDATE clientes
             SET veces = veces + 1
             WHERE cod_cliente = :cod_cliente'
        );

        $stmt->bindValue(':cod_cliente', $codCliente);
        $stmt->execute();

        return $stmt->rowCount() === 1;
    }
}
