<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Salvaje - Suscripciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/subscription.css') }}">
</head>

<body>

    <div class="subscription-container">
        <div class="subscription-header">
            <h1>Zona Salvaje - Suscripción VIP</h1>
            <p>Accede a contenido exclusivo y ventajas especiales.</p>
        </div>

        <div class="subscription-card">
            <h2>Suscripción VIP</h2>
            <p>Accede a contenido exclusivo y zonas especiales.</p>
            <p class="price">19,99€ / mes</p>
            <button onclick="subscribe()">Inscribirse</button>
        </div>
    </div>

    <script>
        function subscribe() {
            window.location.href = '/stripe/checkout.html';
        }
    </script>

</body>

</html>
