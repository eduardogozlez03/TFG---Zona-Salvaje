<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Salvaje - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <script type="module" src="{{ asset('assets/js/home.js') }}" ></script>


</head>

<body>

    <!-- Navbar -->
    @include('profile.partials.navbar')

    <!-- Logo -->
    @include('profile.partials.logo')

    <!-- Slider de imágenes -->
    <section class="hero slider-container">
        <div class="slider-wrapper" id="slider-wrapper">
            <img src="https://i.imgur.com/U9ThN8T.png" class="slider-image active" />
            <img src="https://i.imgur.com/jfBt4TC.png" class="slider-image" />
        </div>

        <div class="hero-content">
            <p class="hero-subtitle">ZONA SALVAJE</p>
        </div>

        <div class="slider-dots" id="slider-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>
    </section>

    <section class="cards-section">
        @foreach ($cardsPrimero as $card)
            <div class="card">
                <img src="{{ $card->image_url }}" alt="Card image" />
                <h3>{{ $card->title }}</h3>
                <p>{{ $card->description }}</p>
            </div>
        @endforeach
    </section>


    <!-- Sección destacada -->
    <section class="gradient-section">
        <!-- Este es el div que tendrá el gradiente encima de las cards -->
        <div class="gradient-overlay"></div>
    </section>

    <!-- Este es el div que contiene las cards -->
    <section class="card-section">
        <div class="card-grid">
            @foreach ($cardsSegundo as $card)
                <div class="card-round">
                    <img src="{{ $card->image_url }}" class="avatar" />
                    <h4>{{ $card->title }}</h4>
                    <p>{{ $card->description }}</p>
                    <a href="{{ $card->link ?? '#' }}" class="card-icon-link">
                        <img src="{{ asset('icons/enlaceCard.svg') }}" alt="Icono" />
                    </a>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Footer -->
    @include('profile.partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/home.js') }}"></script>

    {{-- Spinner oculto --}}
    <!-- Spinner de carga (oculto por defecto) -->
    <div id="loading-spinner" class="loading-spinner" style="display: none;">
        <div class="spinner"></div>
    </div>

</body>

</html>
