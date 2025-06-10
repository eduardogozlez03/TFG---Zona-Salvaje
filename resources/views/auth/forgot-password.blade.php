<x-guest-layout>
    <style>
        /* Estilos consistentes con el login y registro */
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
        
        .password-container {
            width: 100%;
            max-width: 460px;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .password-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .password-title {
            font-size: 24px;
            color: #207E27;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .password-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.6;
        }
        
        .form-group {
            margin-bottom: 25px;
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
            justify-content: flex-end;
            margin-top: 30px;
        }
        
        .reset-button {
            background: linear-gradient(to right, #207E27, #19A224);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 100%;
        }
        
        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(32, 126, 39, 0.3);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .success-message {
            color: #207E27;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 12px;
            background-color: rgba(32, 126, 39, 0.1);
            border-radius: 8px;
            text-align: center;
        }
    </style>

    <div class="password-container">
        <div class="password-header">
            <h1 class="password-title">Recuperar contraseña</h1>
            <p class="password-subtitle">
                ¿Olvidaste tu contraseña? No hay problema. Indícanos tu correo electrónico y te enviaremos un enlace para que puedas establecer una nueva.
            </p>
        </div>

        <!-- Mensaje de estado -->
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}"  autofocus>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="reset-button">
                    Enviar enlace de recuperación
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>