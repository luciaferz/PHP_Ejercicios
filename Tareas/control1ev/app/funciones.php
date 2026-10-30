<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */

//no mejor solucion hay un metodo que se llama arrays_keys que dice si la clave existe en un array 
function userOk($login,$clave):bool {
    global $usuarios;
    $clave = array_keys($usuarios, 6);

    foreach($usuarios as $loginuser => $datosuser){
        if($login == $loginuser && $clave == $datosuser(1)){
            return true;
        }
    }
    return false;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    
    if(isset($usuarios($login))){ //variable que siempre tiene que devolver algo

    }
    return $usuarios($login)[2]; //suponienfo que usario existies
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: ". "FULANITO";
    $msg .= "<table>";
    // Completar
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: ". " D. FULATINO";
    $msg .= "<table>";
    $msg .= "</table>";
    return $msg;
}