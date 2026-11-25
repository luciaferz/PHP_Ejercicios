<?php
require_once __DIR__ . '/app/modelo/Conexion.php';
/* MODELO 5 - CATÁLOGO (SOLUCIÓN COMPLETA)
 * ENUNCIADO: Filtrar productos por categoría y precio máximo, ordenar por
 * precio, mostrar ausencia de resultados y borrar por POST. GET consulta y
 * POST modifica: así se distingue el objetivo de cada método HTTP.
 * prepare() se usa incluso con un id porque cualquier dato externo debe viajar
 * como parámetro y no formando parte del texto SQL. */
$pdo = conectarModelo05();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $s = $pdo->prepare('DELETE FROM productos WHERE id=:id');
    $s->execute([':id' => $_POST['id'] ?? 0]);
}
$cat = trim($_GET['categoria'] ?? '');
$max = $_GET['maximo'] ?? '';
$sql = 'SELECT * FROM productos WHERE 1=1';
$params = [];
// Solo añadimos condiciones fijas; los valores siempre viajan como parámetros.
if ($cat !== '') {
    $sql .= ' AND categoria=:cat';
    $params[':cat'] = $cat;
}
if ($max !== '') {
    $sql .= ' AND precio<=:max';
    $params[':max'] = (float)$max;
}
$sql .= ' ORDER BY precio ASC';
$s = $pdo->prepare($sql);
$s->execute($params);
$productos = $s->fetchAll(PDO::FETCH_ASSOC);
echo '<h1>Catálogo</h1><form method="get"><input name="categoria" placeholder="Categoría"><input name="maximo" type="number" step="0.01" placeholder="Precio máximo"><button>Filtrar</button></form>';
if (!$productos) echo '<p>No hay resultados.</p>';
foreach ($productos as $p) echo '<p>' . htmlspecialchars($p['nombre']) . ' - ' . htmlspecialchars($p['categoria']) . ' - ' . $p['precio'] . ' € <form method="post" style="display:inline"><input type="hidden" name="id" value="' . $p['id'] . '"><button>Borrar</button></form></p>';
