<?php
// La conexión se separa de las consultas para poder reutilizarla y modificarla.
function conectarModelo03(){ $pdo=new PDO('mysql:host=localhost;dbname=examen_material;charset=utf8','root','root'); $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); return $pdo; }
