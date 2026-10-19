<?php
//Pedir longitud excata, usar trim para quitar espacios en blanco 
function usuarioOk($usuario, $contraseña) :bool {

   return  strlen($usuario) >= 8 //strlen:; devuelve la longitud de caracteres, en este caso 8
      && $contraseña === strrev ($usuario); //strrev: devuelve la cadena invertida (contraseña el nombre del usuario al reves)
    
}

//opinion: area de texto para escribir 300 como máximo
//usar trim para evitar que se cuenten los espacion en blacno 
function formulario ($debate, $opinion){

   return strlen($opinion) <= 300;
}