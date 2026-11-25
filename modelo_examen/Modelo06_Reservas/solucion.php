<?php
require_once __DIR__ . '/app/modelo/Conexion.php';
/* MODELO 6 - RESERVA DE TALLER (SOLUCIÓN COMPLETA)
 * ENUNCIADO: Reservar plaza solo si queda alguna. Insertar la reserva y
 * decrementar plazas. Si falla una operación, deshacer todas con rollBack().
 * Una transacción es importante porque INSERT y UPDATE representan una sola
 * reserva lógica: no queremos guardar una sin actualizar las plazas. */
$pdo = conectarModelo06();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<form method="post"><input name="taller" type="number" required placeholder="Id taller"><input name="alumno" required placeholder="Alumno"><button>Reservar</button></form>';
    exit;
}
$id = $_POST['taller'] ?? '';
$alumno = trim($_POST['alumno'] ?? '');
if ($id === '' || $alumno === '') die('Faltan datos.');
try {
    // beginTransaction inicia la unidad de trabajo; commit la confirma.
    $pdo->beginTransaction();
    // FOR UPDATE bloquea la fila mientras se comprueba y se resta la plaza.
    $s = $pdo->prepare('SELECT * FROM talleres WHERE id=:id FOR UPDATE');
    $s->execute([':id' => $id]);
    $t = $s->fetch(PDO::FETCH_ASSOC);
    
    if (!$t) throw new Exception('Taller inexistente.');
    if ($t['plazas'] < 1) throw new Exception('No quedan plazas.');
    $s = $pdo->prepare('INSERT INTO reservas(taller_id,alumno) VALUES(:id,:a)');
    $s->execute([':id' => $id, ':a' => $alumno]);
    $s = $pdo->prepare('UPDATE talleres SET plazas=plazas-1 WHERE id=:id');
    $s->execute([':id' => $id]);
    $pdo->commit();
    echo 'Reserva realizada.';
} catch (Throwable $x) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo 'No se pudo reservar: ' . htmlspecialchars($x->getMessage());
}
