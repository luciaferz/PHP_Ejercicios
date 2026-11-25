<h1>Pedidos</h1>
<form><input name="cliente" placeholder="Cliente"><button>Filtrar</button></form>
<?php foreach ($lista as $p): ?> <p>#<?= $p->id ?> <?= htmlspecialchars($p->cliente) ?> - <?= htmlspecialchars($p->producto) ?> - <?= $p->importe ?> € - <?= htmlspecialchars($p->estado) ?></p>
<?php endforeach; ?>