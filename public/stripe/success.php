<?php
require_once '../../vendor/autoload.php';
require_once '../stripe/secrets.php';

session_start(); // Inicia la sesión

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    die("Usuario no autenticado");
}

$stripe = new \Stripe\StripeClient($stripeSecretKey);

// Captura el session_id de la URL
$session_id = $_GET['session_id'];

try {
    $session = $stripe->checkout->sessions->retrieve($session_id);

    if ($session->status === 'complete' || $session->status === 'active') {
        // Conecta a la base de datos
        $pdo = new PDO("mysql:host=localhost;dbname=tu_basededatos", "tu_usuario", "tu_contraseña");
        
        // Actualiza la suscripción del usuario
        $user_id = $_SESSION['user_id'];
        $subscription = "VIP"; // Puedes cambiar esto según el tipo de suscripción
        
        $stmt = $pdo->prepare("UPDATE users SET subscription = :subscription WHERE id = :id");
        $stmt->execute([
            ':subscription' => $subscription,
            ':id' => $user_id
        ]);

        echo "<h1>¡Gracias por tu compra!</h1>";
        echo "<p>Tu suscripción ha sido activada correctamente como $subscription.</p>";
    } else {
        echo "<h1>Algo salió mal</h1>";
        echo "<p>No se ha completado la suscripción.</p>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
