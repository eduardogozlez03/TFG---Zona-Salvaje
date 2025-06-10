<?php
require_once '../../vendor/autoload.php';
require_once '../stripe/secrets.php';

session_start();
$plan = $_GET['plan'] ?? null;

// Verificar si el usuario está logueado
if (isset($_SESSION['user_id']) && $plan) {
    // Conectarse a la base de datos
    $pdo = new PDO('mysql:host=localhost;dbname=zona_salvaje', 'root', '');
    
    // Actualizar la suscripción del usuario
    $stmt = $pdo->prepare("UPDATE users SET subscription = ? WHERE id = ?");
    $stmt->execute([$plan, $_SESSION['user_id']]);

    // Redirigir al usuario a la página principal
    header("Location: http://localhost:8000");
    exit();
} else {
    echo "Error: No estás autenticado o el plan no es válido.";
}
