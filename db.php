<?php
// Configuración de errores para ver qué falla
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$db   = "liga_basquetbol"; 
$user = "root";
$pass = "";

try {
    // ESTA LÍNEA ES LA QUE CREA LA CONEXIÓN (Te faltaba esto)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error crítico de conexión: " . $e->getMessage());
}
?>