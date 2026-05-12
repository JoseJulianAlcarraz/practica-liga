<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php'; 

if (!isset($_GET['equipo_id'])) { die("ID de equipo no encontrado."); }
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
    <meta charset="UTF-8">
    <title>Plantilla de <?= htmlspecialchars($equipo['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Plantilla: <?= htmlspecialchars($equipo['nombre']) ?></h2>
            <div>
                <a href="crear_jugador.php?equipo_id=<?= $id_equipo ?>" class="btn btn-primary">+ Añadir Jugador</a>
                <a href="index.php" class="btn btn-secondary">Volver al Panel</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Posición</th>
                        <th>Número</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($jugadores as $j): ?>
                    <tr>
                        <td><?= htmlspecialchars($j['nombre']) ?></td>
                        <td><?= htmlspecialchars($j['posicion']) ?></td>
                        <td><?= htmlspecialchars($j['numero']) ?></td>
                        <td class="text-center">
                            <a href="eliminar_jugador.php?id=<?= $j['id'] ?>&equipo_id=<?= $id_equipo ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('¿Borrar a este jugador?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>