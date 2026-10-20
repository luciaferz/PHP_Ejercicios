

<?php 
// PRIMERA APROXIMACIÓN AL MODELO VISTA CONTROLADOR. 
// Funciones auxiliars Ej- usuarioOK
include_once 'app/funciones.php';

// Salida hacia buffer
ob_start(); 
$msg ="";


// Segun la orden 
if ( !isset($_REQUEST['orden']) ){
    include_once 'app/plantillas/entrada.php';
} 
else {
    switch ($_REQUEST['orden']){
        
        case "Entrar":
            // Chequear usuario
            if ( isset($_REQUEST['nombre'], $_REQUEST['contraseña']) &&
                 is_string($_REQUEST['nombre']) && is_string($_REQUEST['contraseña']) &&
                 usuarioOK($_REQUEST['nombre'], $_REQUEST['contraseña'] )) {
               echo " Bienvenido <b>" .
                    htmlspecialchars($_REQUEST['nombre'], ENT_QUOTES, 'UTF-8') .
                    "</b><br>";
               include_once  'app/plantillas/comentario.html';
            }
            else {
                $msg = " Usuario no válido ";
                include_once 'app/plantillas/entrada.php';
                
            }
            break;
            
        case "Nueva opinión":
            echo " Nueva opinión <br>";
            include_once  'app/plantillas/comentario.html';
            break;
        case "Detalles": // Mensaje y detalles
            $debate = $_REQUEST['tema'] ?? '';
            $opinion = $_REQUEST['comentario'] ?? '';

            // Solo se valida si los datos recibidos son textos.
            if (is_string($debate) && is_string($opinion) &&
                formulario($debate, $opinion)) {
                echo "Detalles de su opinión";
                include_once 'app/plantillas/comentariorelleno.php';
                include_once 'app/plantillas/detalles.php';
            } else {
                echo "<p>Escribe un tema y limita la opinión a 300 caracteres.</p>";
                include_once 'app/plantillas/comentariorelleno.php';
            }
            break;
        case "Terminar": // Formulario inicial
            include_once 'app/plantillas/entrada.php';
    }
    
}

$contenido_php = ob_get_clean();

include_once "app/plantillas/principal.php";

?>
