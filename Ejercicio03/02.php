<?php
/*2.- Crear un array que almacene 5 cadenas con el nombre de periódicos y sus enlaces para acceder. 
El array será asociativo con el nombre del periódico como clave y su URL como valor.

 Mostrar un lista html con cinco hiperenlaces a la URL de los diarios */ 

 //Array Asocaitvo
 $medios =  [ "El Pais" => "https://www.elpais.com", 
            "El Mundo" => "https://www.elmundo.es", 
            "ABC" => "https://www.abc.es", 
            "La Vanguardia" => "https://www.lavanguardia.com", 
            "El Confidencial" => "https://www.elconfidencial.com"]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($medios as $nombre => $url): ?>
        <li><a href="<?php echo $url; ?>"><?php echo $nombre; ?></a></li>
        <?php endforeach; ?> <!-- Cerrar el foreach -->
    </ul>
</body>
</html>