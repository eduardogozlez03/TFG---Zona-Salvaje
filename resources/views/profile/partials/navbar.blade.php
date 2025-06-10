<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <script type="module" src="{{ asset('assets/js/navbar.js') }}"></script>

</head>

<header class="navbar">
    <button class="hamburger" id="hamburger">☰</button>

    <nav class="nav-links" id="nav-links">
        @guest
            <!-- Usuario NO autenticado -->
            <a class="link" href="{{ route('login') }}">Iniciar Sesión</a>
            <a class="link" href="{{ route('contacto') }}">Contacto</a>
            <a class='link' href="{{ route('faqs') }}">FAQs</a>
            <div class="nav-buttons">
                <a href="{{ Auth::check() ? route('payment') : route('go.payment') }}"
                    class="btn btn-success">Inscribirte</a>
                <a href="{{ route('login') }}" class="btn secondary">Área cliente</a>
            </div>
        @else
            <!-- Usuario autenticado -->
            <a class="link welcome" href="#">Bienvenido {{ Auth::user()->name }}</a>
            <a class="link" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="link" href="{{ route('contacto') }}">Contacto</a>
            <a class='link' href="{{ route('faqs') }}">FAQs</a>

            <div class="nav-buttons">
                @if (Auth::user()->subscription === 'vip')
                    <a href="{{ route('vip') }}" class="btn btn-success">VIP</a>
                @else
                    <a href="{{ Auth::check() ? route('payment') : route('go.payment') }}"
                        class="btn btn-success">Inscribirte</a>
                @endif
                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.area') }}" class="btn">Área Admin</a>
                    @else
                        <a href="{{ route('cliente.area') }}" class="btn">Área Cliente</a>
                    @endif
                @endauth

            </div>
        @endguest
    </nav>

</header>
