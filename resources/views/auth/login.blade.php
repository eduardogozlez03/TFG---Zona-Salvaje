<x-guest-layout>
    <style>
        /* Reset completo */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            line-height: 1.5;
        }

        /* Contenedor principal - Sin marco de fondo */
        .login-container {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Encabezado */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-title {
            font-size: 24px;
            color: #207E27;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Formulario - Corrección de espacios */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #19A224;
            box-shadow: 0 0 0 3px rgba(25, 162, 36, 0.1);
        }

        /* Checkbox - Corrección de alineación */
        .remember-container {
            display: flex;
            align-items: center;
            margin: 25px 0;
            gap: 10px;
        }

        .remember-checkbox {
            width: 18px;
            height: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            accent-color: #207E27;
        }

        .remember-label {
            color: #64748b;
            font-size: 14px;
        }

        /* Pie de formulario - Corrección de espacios */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-links {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .form-link {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .form-link:hover {
            color: #207E27;
            text-decoration: underline;
        }

        .register-highlight {
            color: #207E27;
            font-weight: 600;
        }

        /* Botón - Más prominente */
        .login-button {
            background: linear-gradient(to right, #207E27, #19A224);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 140px;
            text-align: center;
            flex-shrink: 0;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(32, 126, 39, 0.3);
        }

        /* Mensajes de error */
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Flecha go home*/
        .back-home-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 1.8rem;
            color: #207E27;
            background: #f8fafc;
            border-radius: 50%;
            padding: 12px;
            /* box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); */
            transition: transform 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
            z-index: 999;
            text-decoration: none;
        }

        .back-home-icon:hover {
            transform: scale(1.1);
            /* box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2); */
            color: #155d1b;
        }
    </style>

    <a href="/" class="back-home-icon" title="Volver al inicio">
        <i class="fas fa-arrow-left"></i>
    </a>


    <div class="login-container">
        <div class="login-header">
            <h1 class="login-title">Bienvenido de vuelta</h1>
            <p class="login-subtitle">Ingresa tus credenciales para acceder</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}"
                    autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" class="form-input" type="password" name="password">
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me - Corregido -->
            <div class="remember-container">
                <input id="remember_me" type="checkbox" class="remember-checkbox" name="remember">
                <label for="remember_me" class="remember-label">Recordar sesión</label>
            </div>

            <div class="form-footer">
                <div class="form-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="form-link">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    <a href="{{ route('register') }}" class="form-link">
                        ¿No tienes cuenta? <span class="register-highlight">Regístrate</span>
                    </a>
                </div>

                <button type="submit" class="login-button">
                    Iniciar sesión
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
