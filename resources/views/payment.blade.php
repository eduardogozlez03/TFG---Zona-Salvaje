<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zona Salvaje - Suscripciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/payment.css') }}">
</head>

<body>
    <!-- Logo -->
    @include('profile.partials.logo')

    {{-- BANNER REDISEÑADO CON PARALLAX --}}
    <div class="banner-media">
        <div class="banner-background"></div>
        <div class="banner-overlay"></div>
        <div class="banner-text">
            <h2>Suscríbete y libera tu bestia interior</h2>
        </div>
    </div>

    <div class="container">
        <div class="intro">
            <h2>Compra ya tu suscripción</h2>
            <p>Forma parte de la manada con acceso total a entrenamientos y planes salvajes.</p>
        </div>
        <div class="cards">
            <div class="card"> <img
                    src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?fit=crop&w=600&q=80"
                    alt="Ejercicio" />
                <h3 class="title">Suscripción VIP</h3>
                <p>Accede a rutinas exclusivas, soporte personalizado y contenido premium. Además de acceso total al
                    gimnasio Zona Salvaje</p>
                <div class="price">19,99€/mes</div>
                <button onclick="window.location.href='{{ url('backend_2/public/stripe/checkout.html') }}'">Comprar</button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('profile.partials.footer')
</body>

</html>
