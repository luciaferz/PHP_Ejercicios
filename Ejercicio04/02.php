<?php
/* 2. Crear página que simule un calculadora sencilla, mediante un único archivo 02.php que mostrará un formularios con dos 
campos numéricos y 4 botones con los 4 tipos de operaciones + - * /  posibles. Se incluirá también 3 controles de tipo radio
que indicarán como queremos que se muestre el resultado en decimal, binario o hexadecimal.

El programa php debe comprobar que se han recibido los dos valores numéricos y detectará el error de intento de división 
por cero. Mostrará el resultado calculado según el formato elegido. Por omisión se mostrará en decimal.
*/


//Eleccion de la operacion a realizar
$operacion = $_GET['operacion'];

//Eleccion del tipo de resultado en el formato que se quiera (decimal, binario o hexadecimal)
$formato = $_GET['formato'];


function calcular($num1, $num2, $operacion)
{
    switch ($operacion) {
        case "sumar":
            return $num1 + $num2;
        case "restar":
            return $num1 - $num2;
        case "multiplicar":
            return $num1 * $num2;
        case "dividir":
            if ($num2 != 0) {
                return $num1 / $num2;
            } else {
                return "Error: División por cero";
            }
        default:
            return "Operación no válida";
    }
}

$num1 = $_GET['num1'];
$num2 = $_GET['num2'];

$resultado = calcular($num1, $num2, $operacion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Calculadora</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .calculadora {
            width: 420px;
            max-width: calc(100% - 32px);
            margin: 24px auto;
        }

        header {
            box-sizing: border-box;
            width: 100%;
            padding: 16px 24px;
            background-color: #364fbe;
            color: white;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-weight: bold;
        }

        main {
            padding: 20px 0;
        }

        fieldset {
            width: 100%;
            box-sizing: border-box;
        }

        input[type="radio"] {
            accent-color: red;
        }

        fieldset+fieldset {
            margin-top: 16px;
        }

        input[type="radio"] {
            accent-color: red;
        }
    </style>
</head>

<body>
    <div class="calculadora">
        <header>
            <h1>Mini Calculadora</h1>
        </header>

        <main>
            <form action=02.php method="get">
                Nº 1: <input type="number" name="num1"><br><br>
                Nº 2: <input type="number" name="num2"><br><br>

                <fieldset>
                    <button type="submit" name="operacion" value="sumar">+</button>
                    <button type="submit" name="operacion" value="restar">−</button>
                    <button type="submit" name="operacion" value="multiplicar">×</button>
                    <button type="submit" name="operacion" value="dividir">÷</button>

                    <button type="reset">Borrar</button>
                </fieldset>

                <fieldset>
                    <label><input type="radio" name="formato" value="decimal" checked> Decimal</label>
                    <label><input type="radio" name="formato" value="binario"> Binario</label>
                    <label><input type="radio" name="formato" value="hexadecimal"> Hexadecimal</label>
                </fieldset>

                <br>
                <button type="reset">Borrar</button>

            </form>
        </main>
    </div>
</body>

</html>