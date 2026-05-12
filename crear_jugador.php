<?php 
// 1. EL CANDADO (Debe ser lo primero)
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no hay sesión, cerramos todo y mandamos al login
    header("Location: login.php");
    exit(); 
}
// 2. EL RESTO DEL CÓDIGO (Solo corre si el candado abrió)
require_once 'db.php'; 

if (!isset($_GET['equipo_id'])) {
    die("Error: No se recibió el ID del equipo.");
}
$id_equipo = $_GET['equipo_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre   = $_POST['nombre'];
    $posicion = $_POST['posicion'];
    $numero   = $_POST['numero'];

    $sql = "INSERT INTO jugadores (equipo_id, nombre, posicion, numero) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_equipo, $nombre, $posicion, $numero]);
    
    header("Location: jugadores.php?equipo_id=" . $id_equipo);
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Jugador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="card mx-auto shadow" style="max-width: 450px;">
        <div class="card-header bg-primary text-white"><h5>Añadir Jugador (Modo Admin)</h5></div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3"><label>Nombre:</label><input type="text" name="nombre" class="form-control" required></div>
                <div class="mb-3"><label>Posición:</label>
                    <select name="posicion" class="form-select">
                        <option value="Base">Base</option><option value="Alero">Alero</option><option value="Pivot">Pivot</option>
                    </select>
                </div>
                <div class="mb-3"><label>Número:</label><input type="number" name="numero" class="form-control" required></div>
                <button type="submit" class="btn btn-success w-100">Guardar Jugador</button>
            </form>
        </div>
    </div>
</body>
</html>