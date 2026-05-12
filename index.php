<?php 
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php'; 

// CONSULTA CLAVE: Ordenar por puntos de mayor a menor
$stmt = $pdo->query("SELECT * FROM equipos ORDER BY puntos DESC");
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; background: #f8f9fa; }
        .sidebar { width: 280px; background: #212529; color: white; padding: 20px; flex-shrink: 0; }
        .content { flex-grow: 1; padding: 40px; }
        .nav-link { color: #ced4da; margin-bottom: 10px; }
        .nav-link:hover { color: white; background: #343a40; border-radius: 5px; }
        .badge-pts { font-size: 1rem; }
    </style>
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <h3 class="text-center">🏀 LIGA PRO</h3>
        <hr>
        <nav class="nav flex-column">
            <a href="index.php" class="nav-link active font-weight-bold text-white">🏆 Tabla de Posiciones</a>
            <a href="crear_equipo.php" class="nav-link">➕ Nuevo Equipo</a>
            <hr>
            <p class="small text-muted mb-1">Usuario: <?= $_SESSION['user_nombre'] ?></p>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Cerrar Sesión</a>
        </nav>
    </div>

    <div class="content">
        <h2 class="mb-4">Tabla de Posiciones</h2>
        <div class="card shadow border-0">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th class="text-start ps-4">Equipo</th>
                            <th>PJ</th><th>PG</th><th>PP</th><th>Puntos</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($equipos as $e): ?>
                        <tr class="text-center">
                            <td class="text-start ps-4">
                                <strong><?= htmlspecialchars($e['nombre']) ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars($e['ciudad']) ?></small>
                            </td>
                            <td><?= $e['pj'] ?></td>
                            <td class="text-success fw-bold"><?= $e['pg'] ?></td>
                            <td class="text-danger fw-bold"><?= $e['pp'] ?></td>
                            <td><span class="badge bg-primary badge-pts"><?= $e['puntos'] ?> pts</span></td>
                            <td>
                                <a href="actualizar_puntos.php?id=<?= $e['id'] ?>" class="btn btn-warning btn-sm" title="Actualizar Puntos">⭐</a>
                                <a href="jugadores.php?equipo_id=<?= $e['id'] ?>" class="btn btn-info btn-sm text-white">Jugadores</a>
                                <a href="eliminar.php?id=<?= $e['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar equipo?')">Borrar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>