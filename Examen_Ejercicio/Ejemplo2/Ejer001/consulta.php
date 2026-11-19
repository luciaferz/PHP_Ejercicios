<?php
// Procesar POST si hay datos
// Chequear cookie
// Obtener la lista de productos

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
        </div>
        <div id="content">
            <form name='entrada' method="post">
                <table>
                    <tr>
                        <th></th>
                        <th>no</th>
                        <th>Descripción</th>
                        <th>stock</th>
                        <th>precio</th>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="tproductos[]" value="01"></td>
                        <td>01</td>
                        <td>PRODUCTO COSA01</td>
                        <td>43</td>
                        <td>100</td>
                    <tr>
                    <tr>
                        <td><input type="checkbox" name="tproductos[]" value="60"></td>
                        <td>01</td>
                        <td>PRODUCTO COSA02</td>
                        <td>43</td>
                        <td>100</td>
                    <tr>

                </table>

                <input type="submit" name="orden" value="ACTUALIZAR">
            </form>
        </div>
    </div>
</body>

</html>