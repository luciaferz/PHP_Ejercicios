<?php
// Conexión centralizada: así las consultas no repiten la configuración PDO.
function conectarModelo01()
{
    $pdo = new PDO('mysql:host=localhost;dbname=examen_viajes;charset=utf8', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
