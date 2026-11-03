<?php
session_start();

$msg = "";

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {
  if (isset($_POST['cantidadini'])) {
    // Se toma lo que llego del formulario de bienvenida "name=cantidadini".
    $cantidad = filter_var($_POST['cantidadini'], FILTER_VALIDATE_INT); // Se comprueba que sea un numero entero.

    if ($cantidad !== false && $cantidad > 0) { // Si la cantidad es valida y mayor que 0, se guarda en la sesion.
      $_SESSION['disponible'] = $cantidad;
    } else {
      $msg = "Introduce una cantidad entera mayor que cero.";
    }
  }

  if (! isset($_SESSION['disponible'])) { // Si no hay cantidad guardada, se muestra el formulario de bienvenida.
    // Cuenta la visita una sola vez por sesión para que recargar la bienvenida no la incremente.
    if (!isset($_SESSION['visita_contada'])) {
      $visitas = isset($_COOKIE['visitar']) ? (int)$_COOKIE['visitar'] + 1 : 1;
      
      //Mes
      setcookie('visitar', $visitas, time() + 30 * 24 * 60 * 60);
      $_SESSION['visita_contada'] = true;
    } else {
      $visitas = (int)$_COOKIE['visitar'];
    }
    include 'form_bienvenida.php';

    // No continuo despues de mostrar el formulario.
    exit();
  }
}

$disponible = $_SESSION['disponible'];

// Si realiza una apuesta ----------------------------------
// Llama a procesar apuesta.
if (isset($_POST["apostar"])) {
   $cantidadApuesta = isset($_POST["cantidad"])
    ? filter_var($_POST["cantidad"], FILTER_VALIDATE_INT) // Valida la variable y comprueba si es un numero entero.
    : false;

  $tipoApuesta = $_POST["apuesta"] ?? ""; // Obtiene si es PAR o IMPAR; si no hay nada devuelve cadena vacia.

  if ($cantidadApuesta === false || $cantidadApuesta <= 0) {
    $msg = "Introduce una cantidad entera mayor que cero.";
  } elseif ($cantidadApuesta >= $disponible) {
    $msg = "La apuesta debe ser inferior al saldo disponible.";
  } elseif ($tipoApuesta != "PAR" && $tipoApuesta != "IMPAR") {
    $msg = "Selecciona PAR o IMPAR.";
  } else {
    $msg = procesarApuesta($cantidadApuesta, $disponible, $tipoApuesta);
    $_SESSION['disponible'] = $disponible;
  }

}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || $disponible <= 1) {
  // Usuario se ha quedado sin dinero para apostar.
  if (!isset($_POST["dejar"]) && $disponible <= 1) {
    // Con 1 euro o menos ya no puede hacer una apuesta entera inferior al saldo.
    $msg = "No tienes saldo suficiente para realizar otra apuesta.";
  }
  session_unset(); // Vacía las variables de la sesión.
  session_destroy(); // Elimina la sesión del servidor.
  require "despedida.php";
  exit();
}

// Muestro el formulario si puede seguir apostando.
require_once  "form_apuesta.php";
?>


<?php

/**
 * FUNCIONES AUXILIARES
 */
function procesarApuesta(int $valorapuesta, int &$saldodisponible, string $apuesta): String
{
  $num = random_int(1, 1000); // Se genera un numero aleatorio entre 1 y 1000.
  $resultado = ($num % 2 == 0) ? "PAR" : "IMPAR"; // Ver si el numero es par o impar.

  if ($apuesta == $resultado) {
    $saldodisponible += $valorapuesta; // Si acierta se suma la cantidad apostada al saldo disponible.
    $msgresultado = "RESULTADO DE LA APUESTA: ".$resultado." GANASTE ";
  } else {
    $saldodisponible -= $valorapuesta; // Si falla se resta la cantidad apostada del saldo disponible.
    $msgresultado = "RESULTADO DE LA APUESTA: ".$resultado." PERDISTE ";
  }

  return $msgresultado;
}
