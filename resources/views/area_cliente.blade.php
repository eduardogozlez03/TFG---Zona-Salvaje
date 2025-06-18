<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Área Cliente - Zona Salvaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/area_cliente.css') }}">
    <script type="module" src="{{ asset('assets/js/area_cliente.js') }}"></script>

</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Área de Cliente</h2>
        </div>
        <nav class="sidebar-nav">
            <a href="#info" class="active">
                <span class="icon"><i class="fas fa-user"></i></span>
                <span>Mi Información</span>
            </a>
            <a href="#clases">
                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                <span>Mis Clases</span>
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                <span>Cerrar Sesión</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="main">
        <div class="page-header">
            <!-- Contenedor del logo -->
            <div class="admin-logo-container">
                <div class="admin-logo" onclick="window.location.href='{{ url('/') }}'">ZONA SALVAJE</div>
            </div>
            <a href="{{ url('/') }}" class="home-icon" title="Ir al inicio">
                <i class="fas fa-home"></i>
            </a>

        </div>

        <!-- Información del usuario -->
        <section id="info" class="card">
            <div class="card-header">
                <h1>Bienvenido, {{ $user->name }}</h1>
                <h2><i class="fas fa-user-circle"></i> Mi Información</h2>
            </div>

            <div class="user-info-grid">
                <div class="info-item">
                    <h3>Correo electrónico</h3>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="info-item">
                    <h3>Tipo de suscripción</h3>
                    <p>{{ ucfirst($user->subscription) }}</p>
                </div>

                <div class="info-item">
                    <h3>Fecha de registro</h3>
                    <p>{{ $user->created_at->format('d/m/Y') }}</p>
                </div>

                <div class="info-item">
                    <h3>Suscripción caduca</h3>
                    @if ($user->subscription_ends_at)
                        <p>Te quedan {{ round(now()->diffInMinutes($user->subscription_ends_at) / 1440) }} días</p>
                    @else
                        <p>No aplicable</p>
                    @endif


                </div>
            </div>
        </section>

        <!-- Clases del usuario -->
        <section id="clases" class="card">
            <div class="card-header">
                <h2><i class="fas fa-dumbbell"></i> Mis Clases</h2>
                <span class="badge">{{ count($user->classes) }} Clases</span>
            </div>

            @if ($user->classes->count() > 0)
                <div class="class-list">
                    @foreach ($user->classes as $clase)
                        <div class="class-card">
                            <h3><i class="fas fa-calendar-check"></i> {{ $clase->name }}</h3>

                            <div class="class-meta">
                                <div>
                                    <i class="fas fa-user-tie"></i>
                                    <span>Instructor: {{ $clase->instructor->name }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-calendar-day"></i>
                                    <span>Fecha:
                                        {{ \Carbon\Carbon::parse($clase->class_date)->format('d/m/Y H:i') }}</span>

                                </div>
                                <div>
                                    <i class="fas fa-users"></i>
                                    <span>Capacidad: {{ $clase->capacity }} personas</span>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('client.class.unenroll', $clase->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Estás seguro de darte de baja de esta clase?')">
                                    <i class="fas fa-user-minus"></i> Darse de baja
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-classes">
                    <p>No estás inscrito en ninguna clase actualmente.</p>
                    {{-- <a href="{{ route('classes.index') }}" class="btn btn-primary"> --}}
                    </a>
                </div>
            @endif
        </section>
    </div>

</body>

</html>
