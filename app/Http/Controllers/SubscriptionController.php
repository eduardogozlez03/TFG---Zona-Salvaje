<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SubscriptionController extends Controller
{
    // Método para actualizar la suscripción
    public function update(Request $request)
    {
        // Verificar que el usuario esté autenticado
        if (Auth::check()) {
            $user = Auth::user();
            $plan = $request->input('plan', 'basico'); // Por defecto básico

            // Verificar que el plan sea válido (por ejemplo, 'vip' o 'premium')
            if (in_array($plan, ['vip', 'premium'])) {
                // Actualizar la suscripción del usuario
                $user->subscription = $plan;
                if (!Auth::check()) {
                    return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu suscripción.');
                }

                $user = Auth::user();

                return redirect()->route('home')->with('success', 'Tu suscripción ha sido actualizada a ' . $plan);
            } else {
                return redirect()->route('home')->with('error', 'El plan seleccionado no es válido.');
            }
        }

        return redirect()->route('login')->with('error', 'Debes iniciar sesión para actualizar tu suscripción.');
    }
}
