<?php
$opinion = $_REQUEST['comentario'] ?? '';
$datos = datosOpinion($opinion);
?>
<div>
<b> Detalles:</b><br>
<table>
<tr><td>Longitud:</td><td><?= $datos['caracteres'] ?></td></tr>
<tr><td>Nº de palabras:</td><td><?= $datos['palabras'] ?></td></tr>
<tr><td>Letra más repetida:</td><td><?= htmlspecialchars($datos['caracter_mas_repetido'], ENT_QUOTES, 'UTF-8') ?></td></tr>
<tr><td>Palabra más repetida:</td><td><?= htmlspecialchars($datos['palabra_mas_repetida'], ENT_QUOTES, 'UTF-8') ?></td></tr>
</table>
</div>
