<?php // Vista de listado preparada para productos obtenidos con FETCH_CLASS. 
?>
<?php foreach (($productos ?? []) as $p): ?><p>
    <?= htmlspecialchars($p->nombre) ?> - <?= $p->precio ?> €</p>
<?php endforeach; ?>