<?php
session_start();
require_once 'db.php';

// Si ya está logueado, mandarlo al index
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificamos la contraseña (el dump que pasaste usa el hash estándar de PHP)
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nombre'] = $user['nombre'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Liga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); height: 100vh; display: flex; align-items: center; }
        .card { border-radius: 15px; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card mx-auto shadow-lg" style="max-width: 400px;">
            <div class="card-body p-5">
                <h3 class="text-center mb-4">🏀 Acceso</h3>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger small"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@admin.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Ingresar al Panel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>