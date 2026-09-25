<?php
/*Elegir a azar uno de los cinco medios y  mostrar el enlace seleccionado.­
El Medio recomendado es: El MundoToday * */

//Array Asocaitvo
$medios =  [
    "El Pais" => "https://www.elpais.com",
    "El Mundo" => "https://www.elmundo.es",
    "ABC" => "https://www.abc.es",
    "La Vanguardia" => "https://www.lavanguardia.com",
    "El Confidencial" => "https://www.elconfidencial.com"
];

$aleatorio = array_rand($medios);//Elegir un enlace aleatorio
$urlAleatorio = $medios[$aleatorio];//Obtiene el valor del enlace aleatorio

//Medio recomendado
    $recomendado = ["El MundoToday" => "https://www.elmundotoday.com"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <h1>Medio Aleatorio</h1>
    <p><?php foreach ($recomendado as $nombre => $url);?></p>
    <p><a href="<?php echo $url; ?>" <?php echo $nombre; ?></a></p>

    <h1>Medio Recomendado</h1>
    <p></p>

    
</body>

</html>