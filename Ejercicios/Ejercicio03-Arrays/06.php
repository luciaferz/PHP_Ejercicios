<?php
//Usar uasort: se le pasa el array y una funcion y se dice como se ordena 

/*Incluir el archivo infopaises.php en un programa php (06.php) que me muestre el país que tiene mas población y el nombre de sus ciudades. El programa debe buscar en las tablas. Hacer otra versión (06v2.php) que ordene el array de países usando funciones de la librería y me muestre directamente la última posición, donde debe estar el máximo.

Contenido de infopaises.php:
<?<?php
  // Forma antigua de definir Array en PHP
$paises = array(
    'Francia' => array("Capital" => "París", "Poblacion" => "50000000"),
    'España' => array("Capital" => "Madrid", "Poblacion" => "42000000"),
    'Italia' => array("Capital" => "Roma", "Poblacion"   => "46000000"),
    'Argentina' => array("Capital" => "Buenos Aires", "Poblacion" => "40000000"),
    'Colombia' => array("Capital" => "Bogotá", "Poblacion"  => "36000000"),
    'Chile' => array("Capital" => "Santiago", "Poblacion"   => "36000000"),
    'Suecia' => array("Capital" => "Estocolmo", "Poblacion" => "25000000"),
);
// Forma moderna, mas compacta
$ciudades = [
    'Francia' =>    ["París","Burdeos","Niza","Lille","Nantes"],
    'España' =>     ["Madrid", "Barcelona","León","Sevilla", "Valencia", "Málaga"],
    'Italia' =>     ["Roma", "Venecia","Florencia","Pisa", "Génova", "Milán", "Turín", "Nápoles"],
    'Argentina' =>  ["Buenos Aires", "Córdoba","Parana","Rosario"],
    'Colombia' =>   ["Bogotá", "Medellín","Cali","Barranquilla", "Bucaramanga"],
    'Chile' =>      ["Santiago", "Arica","Iquique","Osorno", "Viña del Mar"],
    'Suecia' =>   ["Estocolmo", "Upsala","Gotemburgo","Lund"],
  ];

   // Ejemplo de uso
   echo $paises["España"]["Capital"]; // Muestra Madrid
*/

?>