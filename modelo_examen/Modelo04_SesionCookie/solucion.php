<?php
/* MODELO 4 - ÁREA DE ALUMNOS (SOLUCIÓN COMPLETA)
 * ENUNCIADO: Guardar nombre y curso en sesión, contar accesos, recordar el
 * último curso con cookie, proteger el contenido y permitir cerrar sesión.
 * La sesión se guarda en el servidor; la cookie se guarda en el navegador.
 * Por eso la sesión sirve para identificar al alumno y la cookie solo recuerda
 * una preferencia que no es sensible. */
session_start(); // Debe ir antes de HTML para que PHP pueda enviar la sesión.
// $_SESSION es un array asociado al usuario actual y se conserva entre peticiones.
if (isset($_GET['salir'])) {
    session_unset();
    session_destroy();
    header('Location: solucion.php');
    exit;
}
    // REQUEST_METHOD indica si se ha enviado el formulario. POST significa que
    // los datos están en $_POST; en GET solo mostraríamos el formulario.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n = trim($_POST['nombre'] ?? '');
    $c = trim($_POST['curso'] ?? '');
    if ($n === '' || $c === '') die('Completa los datos.');
    $_SESSION['nombre'] = $n;
    $_SESSION['curso'] = $c;
    $_SESSION['accesos'] = 0;
}
if (!isset($_SESSION['nombre'])) {
    echo '<form method="post"><input name="nombre" required><input name="curso" required><button>Entrar</button></form>';
    exit;
}
$_SESSION['accesos']++;
$anterior = $_COOKIE['ultimo_curso'] ?? 'Ninguno';
// 2592000 = 30*24*60*60: esta cookie se conserva durante 30 días.
setcookie('ultimo_curso', $_SESSION['curso'], time() + 30*24*60*60, '/');
echo '<h1>Área privada</h1><p>Alumno: ' . htmlspecialchars($_SESSION['nombre']) . '</p><p>Curso: ' . htmlspecialchars($_SESSION['curso']) . '</p><p>Accesos: ' . $_SESSION['accesos'] . '</p><p>Curso anterior: ' . htmlspecialchars($anterior) . '</p><a href="?salir=1">Cerrar sesión</a>';
