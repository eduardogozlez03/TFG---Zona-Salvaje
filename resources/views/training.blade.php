<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Salvaje - Entrenamiento</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/training.css') }}">

    <style>

    </style>
</head>


<body>

    <!-- Navbar -->
    @include('profile.partials.navbar')

    <!-- Logo -->
    @include('profile.partials.logo')

    <!-- Hero de Entrenamiento -->
    <section class="training-hero">
        <div class="hero-overlay">
            <h1>Los entrenamientos más <strong>SALVAJES</strong></h1>
            <p>Los tienes más cerca de lo que crees, así que echa un vistazo y nos cuentas</p>

        </div>

    </section>


    {{--  --}}

    <!-- Sección de Imagen y Texto -->
    <section class="banner-section">
        <div class="banner-text">
            <h2>Entrenamiento de Alto Nivel</h2>
            <p>Disfruta de un espacio creado especialmente para llevar tus entrenamientos a otro nivel. Cómo la bestia
                mas salvaje de la selva , es hora de ponerse en forma</p>
            <p>Ahora te toca ser salvaje a ti , empieza hoy mismo sin excusas</p>
        </div>
        <div class="banner-image">
            <img src="https://i.imgur.com/BNjPNpj.jpeg" alt="Entrenamiento en zona salvaje">
        </div>
    </section>

    <section class="training-section">
        <h2>Entrenamientos</h2>

        <!-- Sección Cardio -->
        <div class="category-section">
            <h3>Cardio</h3>
            <div class="cardio-cards">
                @foreach ($trainingCards->where('category', 'cardio') as $card)
                    <div class="cardio-card">
                        <img src="{{ $card->image_url }}" alt="{{ $card->title }}">
                        <div class="card-info">
                            <h3>{{ $card->title }}</h3>
                            <a href="#" class="card-icon-link" onclick="openDetails('{{ $card->id }}')">
                                <img src="{{ asset('icons/enlaceCard.svg') }}" alt="Icono" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección Bicicleta -->
        <div class="category-section">
            <h3>Bicicleta</h3>
            <div class="cardio-cards">
                @foreach ($trainingCards->where('category', 'bicycle') as $card)
                    <div class="cardio-card">
                        <img src="{{ $card->image_url }}" alt="{{ $card->title }}">
                        <div class="card-info">
                            <h3>{{ $card->title }}</h3>
                            <a href="#" class="card-icon-link" onclick="openDetails('{{ $card->id }}')">
                                <img src="{{ asset('icons/enlaceCard.svg') }}" alt="Icono" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sección Zumba -->
        <div class="category-section">
            <h3>Zumba</h3>
            <div class="cardio-cards">
                @foreach ($trainingCards->where('category', 'zumba') as $card)
                    <div class="cardio-card">
                        <img src="{{ $card->image_url }}" alt="{{ $card->title }}">
                        <div class="card-info">
                            <h3>{{ $card->title }}</h3>
                            <a href="#" class="card-icon-link" onclick="openDetails('{{ $card->id }}')">
                                <img src="{{ asset('icons/enlaceCard.svg') }}" alt="Icono" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Fondo Blanco al Activar Detalles -->
        <div class="overlay-background" id="overlay-background"></div>

        <!-- Card Lateral Expansible -->
        <div class="details-overlay" id="details-overlay">
            <div class="details-card">
                <button class="close-btn" onclick="closeDetails()">×</button>
                <img id="details-image" src="" alt="Imagen del entrenamiento">
                <h2 id="details-title"></h2>
                <p id="details-description"></p>
                <div class="details-info">
                    <p><strong>Duración:</strong> <span id="details-duration"></span> minutos</p>
                    <p><strong>Intensidad:</strong> <span id="details-intensity"></span></p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    @include('profile.partials.footer')


    <script>
        const trainingData = @json($trainingCards);
        let scrollPosition = 0;

        function openDetails(id) {
            event.preventDefault(); // Evita el scroll al inicio

            const overlay = document.getElementById("details-overlay");
            const background = document.getElementById("overlay-background");
            const card = trainingData.find(c => c.id == id);

            document.getElementById("details-image").src = card.image_url;
            document.getElementById("details-title").innerText = card.title;
            document.getElementById("details-description").innerText = card.description;
            document.getElementById("details-duration").innerText = card.duration;
            document.getElementById("details-intensity").innerText = card.intensity;

            // Guardar la posición actual del scroll
            scrollPosition = window.scrollY;
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.width = '100%';

            background.classList.add("active");
            overlay.classList.add("active");
        }

        function closeDetails() {
            const overlay = document.getElementById("details-overlay");
            const background = document.getElementById("overlay-background");

            overlay.classList.remove("active");
            background.classList.remove("active");

            // Restaurar la posición del scroll
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            window.scrollTo(0, scrollPosition);
        }
    </script>

</body>

</html>
