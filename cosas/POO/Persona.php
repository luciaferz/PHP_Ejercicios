<?php

class Persona {
    private int $edad;//= 20;
    private string $nombre;

    //Metodo que no tieine que ver con los objeto -> static (estaticos)
    function mensajeEdad(int $años) : string { //Devuelve un string
        if($años < 18){
            return "Precio infantil";
        }else if($años < 30){
            return "Precio joven";
        }else{
            return "Precio adulto";
        }
    }

    function cumplirAños(): void { //No devuelve nada 
        //obligatorio poner el this
        $this->edad++;

    }

    //Constructor
    function __construct(string $nombre, int $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    //Metodos que todo objeto tiene (metodos magicos)
    function __toString(): string { //Devuelve un string
        return $this->nombre."(".$this->edad.")";
    }

    function __get(string $atributo){
        if($atributo == "nombre"){
            return $this->nombre;
        }

        if($atributo == "edad"){
            return $this->edad -2; //Se puede modificar el valor de la propiedad privada

        }
    }

    function __set(string $name, mixed $value){ //mixed puede ser cualquiero cosa (no hace falta ponerlo)
        if($name == "edad" && $value < 100){
            $this->edad = $value;
        }
    }

}

$pepe = new Persona(25, "Pepe Luiis"); //Cosntructor 
//$pepe->nombre = "Pepe"; - si es publico es un objeto y se quier modificar hay que poner la flecha
//$pepe->edad = 30; - No se puede modificar porque es privado
$pepe->cumplirAños(); //Llamada al metodo cumplirAños
print_r($pepe); //Muestra el objeto con sus propiedades y valores

echo $pepe; //Muestra el objeto con el metodo toString

//Saber solo el nombre
echo "nombre es ". $pepe->getNombre(); //Muestra el nombre del objeto privado (habria que crear el metodo)

//Metodo magico get
echo "nombre es ". $pepe->nombre ."\n" ;

echo "edad es ". $pepe->edad."\n" ; //Muestra la edad del objeto privado (habria que crear el metodo)

//__set - intentar cambiar el nombre
$this->nombre = "Manuel";
$this->edad = 320;

$this->edad = 56; //Se puede cambiar porque es menor a 100
?>