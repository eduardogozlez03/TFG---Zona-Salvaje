<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona VIP - Clases Exclusivas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script type="module" src="{{ asset('assets/js/vip.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/vip.css') }}">
</head>

<body>
    <!-- Efecto flash -->
    <div id="flash-effect" class="flash-effect"></div>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Logo -->
        @include('profile.partials.logo')

        <div class="hero-content">
            <h1 class="hero-title">Zona VIP</h1>
            <p class="hero-subtitle">Acceso exclusivo a nuestras clases premium</p>
        </div>
    </section>

    <!-- Clases VIP -->
    <section class="classes-section">
        <div class="section-header">
            <h2 class="section-title">Clases Exclusivas</h2>
            <p class="section-description">Reserva tu plaza en nuestras sesiones VIP con los mejores instructores</p>
        </div>

        <div class="classes-grid">
            @foreach ($classes as $class)
                <div class="class-card">
                    @if ($class->trainingCard && $class->trainingCard->image_url)
                        <img src="{{ $class->trainingCard->image_url }}" alt="{{ $class->trainingCard->title }}"
                            class="class-image">
                    @else
                        <img src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                            alt="Clase VIP" class="class-image">
                    @endif

                    <div class="class-content">
                        <h3 class="class-title">{{ $class->trainingCard->title ?? 'Clase VIP' }}</h3>
                        <p class="class-description">
                            {{ $class->trainingCard->description ?? 'Descripción no disponible' }}</p>

                        <div class="class-meta">
                            <div class="meta-item">
                                <i>👤</i>
                                <span>{{ $class->instructor ? $class->instructor->name : 'Instructor por asignar' }}</span>
                            </div>
                            <div class="meta-item">
                                <i>📅</i>
                                <span>{{ \Carbon\Carbon::parse($class->class_date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i>⏱️</i>
                                @php
                                    $fecha = \Carbon\Carbon::parse($class->class_date)->startOfDay();
                                    $hoy = \Carbon\Carbon::now()->startOfDay();
                                    $diasRestantes = $hoy->diffInDays($fecha, false);
                                @endphp

                                <span
                                    class="days-left 
                                    {{ $diasRestantes < 0 ? 'ended' : '' }}
                                    {{ $diasRestantes === 0 ? 'today' : '' }}
                                    {{ $diasRestantes > 0 && $diasRestantes <= 3 ? 'soon' : '' }}">
                                    @if ($diasRestantes < 0)
                                        Clase finalizada
                                    @elseif ($diasRestantes === 0)
                                        ¡Es hoy!
                                    @else
                                        Faltan {{ $diasRestantes }} días
                                    @endif
                                </span>
                            </div>
                            <div class="meta-item">
                                <i>🎟️</i>
                                <span>{{ $class->capacity - optional($class->users)->count() }} plazas
                                    disponibles</span>
                            </div>
                        </div>

                        <div class="class-actions">
                            @if (auth()->user()->classes->contains($class->id))
                                <form method="POST" action="{{ route('vip.leave', $class->id) }}" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn leave-btn">
                                        <span>Cancelar reserva</span>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('vip.join', $class->id) }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="action-btn join-btn">
                                        <span>Reservar plaza</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</body>

</html>
