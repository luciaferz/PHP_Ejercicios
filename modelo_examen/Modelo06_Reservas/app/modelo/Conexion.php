<?php
function conectarModelo06()
{
    $pdo = new PDO('mysql:host=localhost;dbname=examen_talleres;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
