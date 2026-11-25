<?php
// Devuelve una conexión PDO preparada para el ejercicio de socios.
function conectarModelo02()
{
    $pdo = new PDO('mysql:host=localhost;dbname=examen_socios;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
