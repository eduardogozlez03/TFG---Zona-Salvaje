<x-guest-layout>
    <style>
        /* Estilos consistentes con el login */
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
        
        .register-container {
            width: 100%;
            max-width: 460px;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-title {
            font-size: 24px;
            color: #207E27;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .register-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
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
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            flex-wrap: wrap;
            gap: 15px;
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
        
        .login-highlight {
            color: #207E27;
            font-weight: 600;
        }
        
        .register-button {
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
        
        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(32, 126, 39, 0.3);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }
        
        /* Estilo específico para mostrar requisitos de contraseña */
        .password-requirements {
            margin-top: 5px;
            font-size: 12px;
            color: #64748b;
        }
    </style>

    <div class="register-container">
        <div class="register-header">
            <h1 class="register-title">Crea tu cuenta</h1>
            <p class="register-subtitle">Únete a Zona Salvaje y comienza tu aventura</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="form-group">
                <label for="name" class="form-label">Nombre completo</label>
                <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}"  autofocus>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" >
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" class="form-input" type="password" name="password" >
                <p class="password-requirements">Mínimo 8 caracteres, incluyendo mayúsculas y números</p>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" >
            </div>

            <div class="form-footer">
                <a href="{{ route('login') }}" class="form-link">
                    ¿Ya tienes cuenta? <span class="login-highlight">Inicia sesión</span>
                </a>

                <button type="submit" class="register-button">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>