<?php
// Forma antigua de definir Array en PHP
$paises = array(
    'Argentina' => 	array("Capital" => "Buenos Aires", 	"Poblacion" => "40000000"),
    'Francia' => 	array("Capital" => "París", 		"Poblacion" => "50000000"),
    'España' => 	array("Capital" => "Madrid", 	"Poblacion" => "42000000"),
    'Italia' => 	array("Capital" => "Roma", 		"Poblacion" => "46000000"),
    'Suiza'=> 		array("Capital" => "Zúrich", 	"Poblacion" =>  "9000000"),
    'Colombia' => 	array("Capital" => "Bogotá", 	"Poblacion" => "36000000"),
    'Chile' => 	array("Capital" => "Santiago", 	"Poblacion" => "36000000"),
    'Suecia' => 	array("Capital" => "Estocolmo", 	"Poblacion" => "25000000"),
);
// Forma moderna, mas compacta
$ciudades = [
    'Argentina' =>  ["Buenos Aires", "Córdoba","Parana","Rosario"],
    'Francia' =>    ["París","Burdeos","Niza","Lille","Nantes"],
    'España' =>     ["Madrid", "Barcelona","León","Sevilla", "Valencia", "Málaga"],
    'Italia' =>     ["Roma", "Venecia","Florencia","Pisa", "Génova", "Milán", "Turín", "Nápoles"],
    'Suiza'  =>     ["Zúrich","Ginebra","Basilea","Lausana"],
    'Colombia' =>   ["Bogotá", "Medellín","Cali","Barranquilla", "Bucaramanga"],
    'Chile' =>      ["Santiago", "Arica","Iquique","Osorno", "Viña del Mar"],
    'Suecia' =>   ["Estocolmo", "Upsala","Gotemburgo","Lund"],
];

function procesarPais($pais){
     global $paises,$ciudades;
    if ( !array_key_exists($pais,$paises) ){
        echo " Error no se encuentra el pais <br>";
    } else {
        echo " Ciudades de $pais :";
        $capital = $paises[$pais]["Capital"];
        foreach ( $ciudades[$pais] as $ciudad){
            if ( $ciudad != $capital ){
                echo "$ciudad, ";
            }
        }
        echo "<br><br>";
    }
}

/**
 * Función auxiliar de ordenación
 */
function forden ( $a, $b){
   return  $a['Poblacion'] - $b ['Poblacion'];
}


function mostrarTablaPaisesOrdendada(){
    global $paises;
    $orden="forden";
    // Orden segun la función indicada manteniendo las claves
    uasort($paises,$orden);
    echo " <table >";
    foreach ($paises as $pais => $datos){
        $poblacion =  number_format($datos['Poblacion'], 0, ',', '.');
        echo "<tr><td> $pais </td><td>$poblacion</td></tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 02</title>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>
<h1> Información sobre un país </h1>

<?php
if (isset($_GET['pais'])){
    procesarPais($_GET['pais']);
    mostrarTablaPaisesOrdendada();
} else {
?>
<hr>
<form method="GET">
País : <input type="text" name="pais" >
<input type=submit value="Enviar">
</form>
<?php }
?>
</body>
</html>


