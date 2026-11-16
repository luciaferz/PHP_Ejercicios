<?php
/*3. Realizar el programa perfil.php que haciendo uso de cookies guarde en el navegador  la edad, sexo y deportes preferidos de un usuario 
durante una semana. El programa mostrará los valores almacenados mediante un formulario para que el usuario pueda modificarlos o borrarlos. 
 Si no existen los cookies se mostrará los campos en blanco.
 */
?>

 <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 380px;">
        <div id="header">
            <h1>SUS DATOS ALMACENADOS</h1>
        </div>

        <div id="content">
            <fieldset>
                <form method="post">
                    <label>Edad</label> <input type="number" name="edad" value=""><br>
                    Género :<br>
                    <label> Mujer </label>
                    <input type="radio" name="genero" value="Mujer">
                    <label> Hombre</label>
                    <input type="radio" name="genero" value="Hombre">
                    <br>
                    <label>Deportes</label><br>
                    <select name="deportes[]" multiple="multiple" size="3">
                        <option value="Futbol">Futbol</option>
                        <option value="Tenis">Tenis</option>
                        <option value="Ciclismo">Ciclismo</option>
                        <option value="Otro">Otro</option>
                    </select>
                    <br>
                    <button name="orden" value="Confirmar"> Almacenar valores </button>
                    <button name="orden" value="Eliminar"> Eliminar valores </button>
                </form>
            </fieldset>
        </div>
    </div>
</body>

</html>
