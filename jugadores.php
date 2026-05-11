<?php 
require_once 'db.php'; 
$id_equipo = $_GET['equipo_id'];

// Obtener nombre del equipo
$stmtE = $pdo->prepare("SELECT nombre FROM equipos WHERE id = ?");
$stmtE->execute([$id_equipo]);
$equipo = $stmtE->fetch(PDO::FETCH_ASSOC);

// Obtener los jugadores
$stmtJ = $pdo->prepare("SELECT * FROM jugadores WHERE equipo_id = ?");
$stmtJ->execute([$id_equipo]);
$jugadores = $stmtJ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Plantilla de <?= htmlspecialchars($equipo['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Plantilla de <?= htmlspecialchars($equipo['nombre']) ?></h2>
        
        <div class="mb-3">
            <a href="crear_jugador.php?equipo_id=<?= $id_equipo ?>" class="btn btn-primary">
                + Añadir Nuevo Jugador
            </a>
            <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>

        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Número</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($jugadores as $j): ?>
                <tr>
                    <td><?= htmlspecialchars($j['nombre']) ?></td>
                    <td><?= htmlspecialchars($j['posicion']) ?></td>
                    <td><?= htmlspecialchars($j['numero']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>