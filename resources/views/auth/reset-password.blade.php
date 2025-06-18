<x-guest-layout>
    <style>
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

        /* Contenedor principal */
        .reset-container {
            width: 100%;
            max-width: 460px;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Encabezado */
        .reset-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .reset-title {
            font-size: 24px;
            color: #207E27;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .reset-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            line-height: 1.6;
        }

        /* Grupos de formulario */
        .form-group {
            margin-bottom: 25px;
        }

        /* Etiquetas */
        .x-input-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 500;
        }

        /* Inputs */
        .x-text-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .x-text-input:focus {
            outline: none;
            border-color: #19A224;
            box-shadow: 0 0 0 3px rgba(25, 162, 36, 0.1);
        }

        /* Mensajes de error */
        .x-input-error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Botón */
        .x-primary-button {
            background: linear-gradient(to right, #207E27, #19A224);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .x-primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(32, 126, 39, 0.3);
        }

        /* Flecha para volver a home */
        .back-home-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 1.8rem;
            color: #207E27;
            background: #f8fafc;
            border-radius: 50%;
            padding: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, color 0.3s ease;
            z-index: 999;
            text-decoration: none;
        }

        .back-home-icon:hover {
            transform: scale(1.1);
            color: #155d1b;
        }

        /* Espaciado para los elementos del formulario */
        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        /* Flex container para el botón */
        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-end {
            justify-content: flex-end;
        }

        /* Clase para el ancho completo */
        .w-full {
            width: 100%;
        }

        /* Clase para bloques */
        .block {
            display: block;
        }
    </style>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
