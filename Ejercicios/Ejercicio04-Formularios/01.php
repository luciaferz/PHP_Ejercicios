<?php
/*1. Elaborar programa (01.php) en php que procese un formulario (01.html) que solicita al usuario un nombre y una clave. 
El programa php tendrá un array asociativo con 3 pares de valores de usuario => contraseña.  
Se comprobará consultando la tabla si los datos son válidos, en este caso se debe mostrar un mensaje de bienvenida con nombre 
introducido , en otro caso se mostrar un mensaje de error para que usuario pueda volver a introducir nuevos datos.*/

//Array Asociativo
$valores=[
    "Ana" =>"1234",
    "Juan" => "5678",
    "Maria" => "9101"
];

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

//Comprobamos si el usuario y la contraseña son correctos
if($valores[$usuario] == $contrasena){
    echo "Bienvenido $usuario";
}else{
    echo"Los datos introuducidos son incorrectos, vuelva a intentarlo";
}


?>