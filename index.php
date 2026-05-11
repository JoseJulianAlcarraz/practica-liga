<?php 
// 1. Incluimos la conexión
require_once 'db.php'; 

// 2. Intentamos traer los equipos antes de mostrar el HTML
try {
    $stmt = $pdo->query("SELECT * FROM equipos");
    $equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Liga de Básquetbol - Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">🏀 NBA Local Manager</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Equipos Registrados</h4>
                <a href="crear_equipo.php" class="btn btn-primary">Añadir Equipo</a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Equipo</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($equipos) > 0): ?>
                            <?php foreach($equipos as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= $row['ciudad'] ?></td>
                                    <td>
                                        <a href="jugadores.php?equipo_id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Jugadores</a>
                                        <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar equipo?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No hay equipos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>