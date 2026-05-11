<?php 
require_once 'db.php'; 

// 1. Verificar conexión y ID del equipo
if (!isset($_GET['equipo_id'])) {
    die("Error: No se recibió el ID del equipo. Regresa a la lista de equipos.");
}
$id_equipo = $_GET['equipo_id'];

// 2. Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Usamos los nombres estándar: 'nombre', 'posicion' y 'numero'
    $nombre   = $_POST['nombre'];
    $posicion = $_POST['posicion'];
    $numero   = $_POST['numero'];

    try {
        $sql = "INSERT INTO jugadores (equipo_id, nombre, posicion, numero) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_equipo, $nombre, $posicion, $numero]);
        
        // Redirigir a la tabla de jugadores
        header("Location: jugadores.php?equipo_id=" . $id_equipo);
        exit; 
    } catch (PDOException $e) {
        die("Error en la Base de Datos: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Jugador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow" style="max-width: 450px;">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Añadir Jugador</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posición:</label>
                        <select name="posicion" class="form-select" required>
                            <option value="Base">Base</option>
                            <option value="Escolta">Escolta</option>
                            <option value="Alero">Alero</option>
                            <option value="Ala-Pívot">Ala-Pívot</option>
                            <option value="Pívot">Pívot</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Dorsal:</label>
                        <input type="number" name="numero" class="form-control" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar Jugador</button>
                        <a href="jugadores.php?equipo_id=<?= $id_equipo ?>" class="btn btn-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>