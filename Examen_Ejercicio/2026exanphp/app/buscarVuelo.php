<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';

$destino = $_GET['destino'];

$ac = AccesoDatos::initModelo();

//Parcialmente hecho (si es madrid te muestra cosas sino no - tiene que aparecer los distinto destinos)
if ($destino == "Madrid") {
        include 'vistas/listado.php';
    } else {
        include 'vistas/error.php';
    }




 
