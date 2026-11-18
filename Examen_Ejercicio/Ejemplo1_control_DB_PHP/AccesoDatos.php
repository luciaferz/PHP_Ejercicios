<?php
include_once "Cliente.php";
include_once "Pedidio.php";

private function __construct(){
        // Abre la conexión PDO con la base de datos.
        try {
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

     public function getCliente($nombre, $clave){
        $resu = null;

        $stmt = $this->dbh->prepare("SELECT * FROM Cliente WHERE nombre = :nombre  and clave = :clave");
        $stmt->bindValue(":nombre", $nombre);
        $stmt->bindValue(":clave", $clave);
        $stmt->setFetchMOde(PDO::FETCH_CLASS), "CLiente";

        if($stmt->execute()){   
            $resu = $stmt->fetch();
            
        }

        return $resu;
    }



?>