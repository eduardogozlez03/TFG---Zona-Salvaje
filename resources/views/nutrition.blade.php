<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona Salvaje - Nutrición</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/nutrition.css') }}">
    <script type="module" src="{{ asset('assets/js/nutrition.js') }}"></script>

</head>


<body>

    <!-- Navbar -->
    @include('profile.partials.navbar')

    <!-- Logo -->
    @include('profile.partials.logo')

    <!-- Hero de Entrenamiento -->
    <section class="training-hero">
        <div class="hero-overlay">
            <h1>¿Quieres una nutrición <strong>SALVAJE</strong>?</h1>
            <p>Ponte en forma con los mejores alimentos posibles</p>
        </div>
    </section>

    <!-- Sección de Imagen y Texto -->
    <section class="banner-section">
        <div class="banner-text">
            <h2>¿Porque es importante la nutrición?</h2>
            <p>La nutrición marca el estilo de vida que quieres llevar , es la responsable de que tu cuerpo tenga a
                disposición las herramientas para que tu cuerpo funcione correctamente . Debes abastecerlo de forma sana
                y el se encargara del resto</p>
        </div>
        <div class="banner-image">
            <img src="https://i.imgur.com/dWYpfq6.jpeg" alt="Entrenamiento en zona salvaje">
        </div>
    </section>

    <section class="training-section">
        <h2>Nutriciones</h2>

        <!-- Sección Nutrición Deportiva -->
        <div class="category-section">
            <h3>Nutrición Deportiva</h3>
            <div class="cardio-cards">
                @foreach ($nutritionCards->where('category', 'deportiva') as $card)
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

        <!-- Sección Terapeutica -->
        <div class="category-section">
            <h3>Terapeutica</h3>
            <div class="cardio-cards">
                @foreach ($nutritionCards->where('category', 'terapeutica') as $card)
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

        <!-- Sección Etapa de Vida -->
        <div class="category-section">
            <h3>Nutrición por Etapa de Vida</h3>
            <div class="cardio-cards">
                @foreach ($nutritionCards->where('category', 'etapa_vida') as $card)
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
                    <p><strong>Categoría:</strong> <span id="details-category"></span></p>
                    <p><strong>Nutrición:</strong> <span id="details-nutrients"></span></p>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    @include('profile.partials.footer')


    <script></script>

</body>

<script>
    const nutritionData = @json($nutritionCards);

    let scrollPosition = 0;

    function openDetails(id) {
        event.preventDefault(); // Evita el scroll al inicio

        const overlay = document.getElementById("details-overlay");
        const background = document.getElementById("overlay-background");
        const card = nutritionData.find(c => c.id == id);

        document.getElementById("details-image").src = card.image_url;
        document.getElementById("details-title").innerText = card.title;
        document.getElementById("details-description").innerText = card.description;
        document.getElementById("details-category").innerText = card.category;
        document.getElementById("details-nutrients").innerText = card.nutrients;

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

</html>
