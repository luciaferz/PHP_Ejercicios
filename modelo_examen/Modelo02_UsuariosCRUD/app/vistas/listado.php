<?php // Vista preparada para recibir una lista de objetos Socio. 
?>
<table border="1"><?php foreach (($socios ?? []) as $s): ?><tr>
            <td><?= htmlspecialchars($s->login) ?></td>
            <td><?= htmlspecialchars($s->nombre) ?></td>
        </tr><?php endforeach; ?></table>