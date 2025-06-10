<?php

// PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = Auth::user();
        $plan = $request->input('subscription');

        // Aquí asignas el ID del precio de Stripe según el plan seleccionado
        $stripePriceId = match ($plan) {
            'VIP' => 'price_1RPkNJ2UNE80AybWvnCwJqHK', // Reemplaza con tu ID de precio real de Stripe
            'Premium' => 'price_1DEF456', // Si tienes más planes
            default => 'price_1ABC123', // El valor predeterminado
        };

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $stripePriceId,
                'quantity' => 1,
            ]],
            'mode' => 'subscription', // Cambiado a suscripción para pagos recurrentes
            'success_url' => route('payment.success', ['subscription' => $plan]),
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    // Éxito en el pago
    public function success(Request $request)
    {
        $user = Auth::user();
        dd($user); // Verificar el usuario autenticado
        $subscription = $request->input('subscription');
        $user->subscription = $subscription;
        $user->save();

        return redirect('/dashboard')->with('success', '¡Suscripción completada correctamente!');
    }

    public function cancel()
    {
        return redirect()->route('subscription.view')->with('error', 'El pago ha sido cancelado.');
    }
}

