<?php
require_once __DIR__ . '/modelo/AccesoDatos.php';
$cliente = $_GET['cliente'] ?? '';
$lista = AccesoDatos::getModelo()->pedidos($cliente);
require __DIR__ . '/vistas/listado.php';
