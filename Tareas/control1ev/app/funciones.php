<?php
require_once('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */

function userOk($login, $clave): bool
{
    global $usuarios;

    if (
        !array_key_exists($login, $usuarios) //Comprobar si el login existe como clave del array - es verdadero cuando no existe
        || $usuarios[$login][1] !== $clave) { //Acceder a la contraseña guardada para ese usuario. El indice 1 correponde al segundo dato de cada usuario (contraseña)
        return false;
    }

    return true;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login)
{
    global $usuarios;

    if (isset($usuarios[$login])) {
        return $usuarios[$login][2]; //suponienfo que usario existies
    }

    return null;
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: " . $usuarios[$codigo][0];
    $msg .= "<table>";
    // Completar
    $msg .= "<tr><th>Módulo</th><th>Nota</th></tr>";
    foreach ($nombreModulos as $indice => $modulo) {
        $msg .= "<tr><td>" . $modulo . "</td>";
        $msg .= "<td>" . $notas[$codigo][$indice] . "</td></tr>";
    }

    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido Profesor: " . $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><th>Alumno</th>";
    foreach ($nombreModulos as $modulo) {
        $msg .= "<th>" . $modulo . "</th>";
    }
    $msg .= "</tr>";

    foreach ($notas as $codigoAlumno => $notasAlumno) {
        $msg .= "<tr><td>" . $usuarios[$codigoAlumno][0] . "</td>";
        foreach ($notasAlumno as $nota) {
            $msg .= "<td>" . $nota . "</td>";
        }
        $msg .= "</tr>";
    }

    $msg .= "</table>";
    return $msg;
}
