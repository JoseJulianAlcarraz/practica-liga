<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, lo expulsa al login inmediatamente
    header("Location: login.php");
    exit;
}
// Aquí sigue el resto de tu código...<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM equipos WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: index.php");
?>