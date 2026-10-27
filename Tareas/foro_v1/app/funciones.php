<?php
//Pedir longitud excata, usar trim para quitar espacios en blanco 
function usuarioOk(string $usuario, string $contraseña) :bool {

   return  strlen($usuario) >= 8 //strlen:; devuelve la longitud de caracteres, en este caso 8
      && $contraseña === strrev ($usuario); //strrev: devuelve la cadena invertida (contraseña el nombre del usuario al reves)   
}

function formulario (string $debate, string $opinion): bool{
   return trim($debate) !== '' //El tema no puede estar vacío ni contener solo espacios
   && strlen($opinion) <= 300; //Area de texto para escribir 300 como máximo
}

function datosOpinion(string $opinion): array
{
   // Se pasa el texto a minúsculas para que "A" y "a" cuenten igual.
   $caracteres = str_split(strtolower($opinion));
   $palabras = str_word_count(strtolower($opinion), 1, 'áéíóúüñ');

   // Se cuenta cuántas veces aparece cada carácter.
   $repeticionesCaracteres = [];
   foreach ($caracteres as $caracter) {
      if (isset($repeticionesCaracteres[$caracter])) {
         $repeticionesCaracteres[$caracter] =
            $repeticionesCaracteres[$caracter] + 1;
      } else {
         $repeticionesCaracteres[$caracter] = 1;
      }
   }

   // Se cuenta cuántas veces aparece cada palabra.
   $repeticionesPalabras = [];
   foreach ($palabras as $palabra) {
      if (isset($repeticionesPalabras[$palabra])) {
         $repeticionesPalabras[$palabra] =
            $repeticionesPalabras[$palabra] + 1;
      } else {
         $repeticionesPalabras[$palabra] = 1;
      }
   }

   // Se busca el carácter con el contador más alto.
   $caracterMasRepetido = 'Ninguno';
   $maxCaracteres = 0;
   foreach ($repeticionesCaracteres as $caracter => $cantidad) {
      if ($cantidad > $maxCaracteres) {
         $caracterMasRepetido = $caracter;
         $maxCaracteres = $cantidad;
      }
   }

   // Se busca la palabra con el contador más alto.
   $palabraMasRepetida = 'Ninguna';
   $maxPalabras = 0;
   foreach ($repeticionesPalabras as $palabra => $cantidad) {
      if ($cantidad > $maxPalabras) {
         $palabraMasRepetida = $palabra;
         $maxPalabras = $cantidad;
      }
   }

   // Se devuelven juntos los datos que necesita mostrar el informe.
   return [
      'caracteres' => strlen($opinion),
      'palabras' => count($palabras),
      'caracter_mas_repetido' => $caracterMasRepetido,
      'palabra_mas_repetida' => $palabraMasRepetida,
   ];
}
