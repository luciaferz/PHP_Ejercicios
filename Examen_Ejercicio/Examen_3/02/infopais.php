<?php

// DATOS DEL EJERCICIO: cada país guarda su capital y su población.
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
// DATOS DEL EJERCICIO: cada país tiene una lista de ciudades que incluye su capital.
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

// Ejemplo de acceso: echo $paises["España"]["Capital"]; mostraría "Madrid".


function procesarPais($pais){
    // Usa los arrays definidos fuera de esta función.
    global $paises, $ciudades;
    // Comprueba si el país escrito existe como clave en el array de países.
    if ( !array_key_exists($pais,$paises) ){
        echo "Error: no se encuentra el país.<br>";
    } else {
        // Obtiene la capital para poder excluirla de la lista de ciudades.
        $capital = $paises[$pais]["Capital"];
        echo "Ciudades de $pais, excepto su capital: ";
        // Recorre las ciudades del país e imprime todas menos la capital.
        foreach ( $ciudades[$pais] as $ciudad){
            if ( $ciudad != $capital ){
                echo "$ciudad, ";
            }
        }
        echo "<br><br>";
    }
}

// Función auxiliar para ordenar países de menor a mayor población.
function forden ( $a, $b){
   return  $a['Poblacion'] - $b ['Poblacion'];
}


function mostrarTablaPaisesOrdendada(){
    global $paises;
    $orden="forden";
    // Ordena los países por población y conserva sus nombres como claves.
    uasort($paises,$orden);
    echo "<table>";
    echo "<tr><th>País</th><th>Población</th></tr>";
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
// Si el formulario ya envió un país, procesa sus ciudades y muestra la tabla.
if (isset($_GET['pais'])){
    procesarPais($_GET['pais']);
    mostrarTablaPaisesOrdendada();
} else {
?>
<hr>
<!-- El formulario envía el país escrito mediante GET, usando el nombre "pais". -->
<form method="GET">
País : <input type="text" name="pais" >
<input type=submit value="Enviar">
</form>
<?php }
?>
</body>
</html>