
<?php
session_start();
if ( !isset($_SESSION['contador'])){
    $_SESSION['contador']=0;
}

$anular = false;
if (isset($_GET['orden'])){
    switch ($_GET['orden']){
        case "Incrementar":  
            $_SESSION['contador']++; break;
        case "Decrementar":   
            $_SESSION['contador']--; break;
        case "Anular": 
            session_destroy();
            $anular = true;
            break;
        case "Recargar":
            // Recarga la pagina actual da igual su nombre.
            header ("location: ".$_SERVER['PHP_SELF']."");
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 01</title>
</head>
<body>
<h1> Contador con sesión</h1>
<?php if ($anular): ?>
La sesion ha sido anulada 
    <form method="GET">
    <button name="orden" value="Recargar">Recargar</button>
    </form>
<?php else: ?>
    Valor del contador <?=$_SESSION['contador'] ?> <br>
    <form method="GET">
    <button name="orden" value="Incrementar">Incrementar</button>
    <button name="orden" value="Decrementar">Decrementar</button>
    <button name="orden" value="Anular">Anular</button>
    </form>
<?php endif ?>
</body>
</html>