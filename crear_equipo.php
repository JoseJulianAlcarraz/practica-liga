<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, lo expulsa al login inmediatamente
    header("Location: login.php");
    exit;
}
// Aquí sigue el resto de tu código...<?php 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php'; 

if ($_POST) {
    try {
        $stmt = $pdo->prepare("INSERT INTO equipos (nombre, ciudad) VALUES (?, ?)");
        $stmt->execute([$_POST['nombre'], $_POST['ciudad']]);
        header("Location: index.php");
    } catch (PDOException $e) {
        die("Error al guardar: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Nuevo Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card p-4 mx-auto shadow" style="max-width: 500px;">
        <h3>Añadir Equipo</h3>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre del Equipo" class="form-control mb-2" required>
            <input type="text" name="ciudad" placeholder="Ciudad" class="form-control mb-2" required>
            <button type="submit" class="btn btn-primary w-100">Guardar</button>
            <a href="index.php" class="btn btn-link w-100 mt-2">Volver</a>
        </form>
    </div>
</body>
</html>