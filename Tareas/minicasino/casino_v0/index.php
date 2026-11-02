<?php
session_start();

// Cambiar  visitar --> VALOR DE COOKIE
// Cambiar disponible --> VALOR DE SESSION

// Actualizo el cookie de visitas
$visitas = isset($_COOKIE['visitar']) //Comprobar si el navegador envio una cookie llamada "visitar"
  ? (int)$_COOKIE['visitar'] + 1 //Si la cookie existe se convierte su valor a entere (int) y se suma 1 
  : 1; //Si no existe la cookie se inicializa a 1

// Un mes  
setcookie('visitar', $visitas, time() + 30 * 24 * 60 * 60);

$msg = "";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {

  //Se toma lo que llego del formulario de bienvenida "name="cantidadini" 
  if (isset($_POST['cantidadini'])) {
    $cantidad = filter_var($_POST['cantidadini'], FILTER_VALIDATE_INT); //Se compueba si es un numero entero devuelve el valor, si no devuelve false

    if ($cantidad !== false && $cantidad > 0) { //Si la cantidad es valida y mayor que 0, y guardala en la sesion
      $_SESSION['disponible'] = $cantidad;
    } else {
      $msg = "Introduce una cantidad entera mayor que cero.";
    }
  }

  if (! isset($_SESSION['disponible'])) { //Si todavia no hay una cantidad guardada en la sesion, se muestra el formulario de bienvenida
    include 'form_bienvenida.php';

    // No continuo despues de mostrar los formularios
    exit();
  }
}

$disponible = $_SESSION['disponible'];

// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
   $cantidadApuesta = isset($_POST["cantidad"])
    ? filter_var($_POST["cantidad"], FILTER_VALIDATE_INT)//filter_var() valida la variable y comprueba que sea un numero entero. Si no es devulve false
    : false;

  $tipoApuesta = $_POST["apuesta"] ?? ""; //Obtiene si es PAR o IMPAR, si no hay nada devuelve cadena vacia

  if ($cantidadApuesta === false || $cantidadApuesta <= 0) {
    $msg = "Introduce una cantidad entera mayor que cero.";
  } elseif ($cantidadApuesta >= $disponible) {
    $msg = "Error: no dispone de " . $cantidadApuesta . " euros disponibles ";
  } elseif ($tipoApuesta != "PAR" && $tipoApuesta != "IMPAR") {
    $msg = "Selecciona PAR o IMPAR.";
  } else {
    $msg = procesarApuesta($cantidadApuesta, $disponible, $tipoApuesta);
    $_SESSION['disponible'] = $disponible;
  }

}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0)) {
 
//Usuario decide abandonar el casino
  if (isset($_POST["dejar"])) {
    echo "<p>Muchas gracias por jugar con nosotros.</p>";
    echo "<p>Su resultado final: es de " . htmlspecialchars((string)$disponible) . " euros.</p>";
    session_unset();//Vacía todas las variables de sesión 
    session_destroy();//Elimina los datos de esa sesion del servidor
  }
  exit();
}

//Usuario se ha quedado sin dinero
if ($disponible <= 0) {
  echo "<p>" . htmlspecialchars($msg . " Te has quedado sin dinero.") . "</p>";
  echo "<p>Su resultado final: es de " . htmlspecialchars((string)$disponible) . " euros</p>";
  session_unset();
  session_destroy();
}
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int &$saldodisponible, string $apuesta): String
{
  $num = random_int(1, 10000); //Se genera un numero aleatorio entre 1 y 10000
  $resultado = ($num % 2 == 0) ? "PAR" : "IMPAR"; //Ver si el numero es par o impar

  $msgresultado = "";

  if ($apuesta == $resultado) {
    $saldodisponible += $valorapuesta; //Si acierta se suma la cantidad apostada al saldo disponible
    $msgresultado = "RESULTADO DE LA APUESTA: ".$resultado." GANASTE ";
  } else {
    $saldodisponible -= $valorapuesta; //Si falla se resta la cantidad apostada al saldo disponible
    $msgresultado = "RESULTADO DE LA APUESTA: ".$resultado." PERDISTE ";
  }

  return $msgresultado;
}
