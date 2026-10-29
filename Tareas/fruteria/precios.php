<?php
$precios = [
    'Platanos' => ['nombre' => 'Plátanos', 'precio' => 1.80],
    'Naranjas' => ['nombre' => 'Naranjas', 'precio' => 2.20],
    'Limones' => ['nombre' => 'Limones', 'precio' => 2.50],
    'Manzanas' => ['nombre' => 'Manzanas', 'precio' => 2.80],
];

function generarOpciones(): string
{
    global $precios;
    $opciones = '';

    foreach ($precios as $clave => $fruta) {
        $opciones .= '<option value="' . htmlspecialchars($clave) . '">'
            . htmlspecialchars($fruta['nombre'])
            . '</option>';
    }

    return $opciones;
}