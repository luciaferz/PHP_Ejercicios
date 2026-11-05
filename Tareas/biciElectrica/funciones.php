<?php
require_once("BiciElectrica.php");

// Leer el fichero csv y devuelve una tabla de bicicletas
function cargarbicis(): array
{
    $fich = @fopen("Bicis.csv", "r");
    if ($fich == false) {
        die("Error al abrir el fichero");
    }
    $tabla = [];

    while ($valor = fgetcsv($fich)) {
        list($id, $cx, $cy, $bat, $op) = $valor;
        $bici = new BiciElectrica($id, $cx, $cy, $bat, $op);
        $tabla[] = $bici;
    }

    return $tabla;
}
// Devuelve una cadena con la tabla html de bicis operativas
function mostrartablabicis($tabla): string
{    
    //Es una tabla de objetos - acceder mediante set y get
    $cadena = "<table><tr><th>Id</th><th>Coord X</th><th>Cood Y</th><th>Bateria</th></tr>";
       foreach($tabla as $bici){
        if (!$bici->operativa) {//La tabla no muestre bicis no disponibles
            continue;
        }

        $cadena .= "<tr>";
        $cadena .= "<td>" . $bici->id . "</td>";
        $cadena .= "<td>" . $bici->coordx . "</td>";
        $cadena .= "<td>" . $bici->coordy . "</td>";
        $cadena .= "<td>" . $bici->bateria . "</td>";
        $cadena .= "</tr>";
       }
    $cadena .="</table>";

    return $cadena;
}

/**
 * Devuelve la bici con menor distancia a las coordenadas de usuario. 
 * @param $tabla - tabla de bicicletas
 * @param $x - Coordenada x de usuario
 * @param $y - Coordenada x de usuario
 * @return bicicleta más cercana o null
 */
function bicimascercana($x, $y, array $tabla)
{
    $bicicerca = null;
    $distanciaMenor = null;

    foreach ($tabla as $bici) {
        //Si la  bicicleta no está operativa, se  ignora.
        if (!$bici->operativa) {
            continue;
        }

        //Llamar a la funcion distancia para calcular la distancia entre esta bici y la ubicación del usuario.
        $distancia = $bici->distancia($x, $y);

        //Se guarda la bici si es la primera disponible o está más cerca.
        if ($distanciaMenor === null || $distancia < $distanciaMenor) {
            $distanciaMenor = $distancia; // Guarda lo lejos que está
            $bicicerca = $bici; // Guarda cuál es la bici
        }
    }

    //Devolver la bici más cercana, o null si ninguna estaba disponible.
    return $bicicerca;
}
