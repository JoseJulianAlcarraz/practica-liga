<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
require_once 'db.php';

if (isset($_GET['id']) && isset($_GET['equipo_id'])) {
    $id = $_GET['id'];
    $equipo_id = $_GET['equipo_id'];

    $stmt = $pdo->prepare("DELETE FROM jugadores WHERE id = ?");
    $stmt->execute([$id]);

    // Redirige de vuelta a la plantilla del equipo
    header("Location: jugadores.php?equipo_id=" . $equipo_id);
    exit();
} else {
    header("Location: index.php");
    exit();
}