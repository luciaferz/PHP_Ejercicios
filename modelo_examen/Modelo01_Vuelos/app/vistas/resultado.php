<?php // Vista reutilizable: recibe un array de objetos Tren en $trenes. 
?>
<?php foreach (($trenes ?? []) as $tren): ?>
    <p><?= htmlspecialchars($tren->codigo) ?> - <?= htmlspecialchars($tren->destino) ?> - <?= $tren->precio ?> €</p>
<?php endforeach; ?>