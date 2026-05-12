<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, lo expulsa al login inmediatamente
    header("Location: login.php");
    exit;
}
// Aquí sigue el resto de tu código...<?php
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM equipos WHERE id = ?");
$stmt->execute([$id]);
$equipo = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pj = $_POST['pj'];
    $pg = $_POST['pg'];
    $pp = $_POST['pp'];
    $puntos = ($pg * 2) + ($pp * 1); // Regla común: 2 pts por ganar, 1 por perder

    $sql = "UPDATE equipos SET pj=?, pg=?, pp=?, puntos=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pj, $pg, $pp, $puntos, $id]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Puntos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card mx-auto shadow" style="max-width: 400px;">
        <div class="card-header bg-warning">Actualizar Marcador: <?= $equipo['nombre'] ?></div>
        <form method="POST" class="card-body">
            <label>Partidos Jugados</label>
            <input type="number" name="pj" value="<?= $equipo['pj'] ?>" class="form-control mb-2">
            <label>Ganados</label>
            <input type="number" name="pg" value="<?= $equipo['pg'] ?>" class="form-control mb-2">
            <label>Perdidos</label>
            <input type="number" name="pp" value="<?= $equipo['pp'] ?>" class="form-control mb-3">
            <button class="btn btn-success w-100">Guardar Estadísticas</button>
        </form>
    </div>
</body>
</html>