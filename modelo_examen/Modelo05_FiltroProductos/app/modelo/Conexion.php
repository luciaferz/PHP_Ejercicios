<?php
function conectarModelo05()
{
    $pdo = new PDO('mysql:host=localhost;dbname=examen_catalogo;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
