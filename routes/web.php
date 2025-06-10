<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\NutritionCardController;
use App\Http\Controllers\SubscriptionController;

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/training', [TrainingController::class, 'index'])->name('training');

Route::get('/nutrition', [NutritionCardController::class, 'index'])->name('nutrition');



Route::get('/subscription/success', function (Request $request) {
    if (Auth::check() && $request->has('subscription')) {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->subscription = $request->subscription;
        $user->save();

        return redirect('/')->with('success', 'Suscripción actualizada correctamente.');
    }

    return redirect('/login');
})->name('subscription.success');


Route::get('/payment', function () {
    return view('payment');
})->middleware('auth')->name('payment');

Route::get('/go-to-payment', function (Request $request) {
    session(['url.intended' => route('payment')]); // guardar en sesión el destino
    return redirect()->route('login'); // redirigir al login
})->name('go.payment');


use App\Http\Controllers\ClassController;

Route::middleware(['auth'])->group(function () {
    Route::get('/vip', [ClassController::class, 'index'])->name('vip');

    Route::post('/vip/join/{id}', [ClassController::class, 'join'])->name('vip.join');
    Route::delete('/vip/leave/{id}', [ClassController::class, 'leave'])->name('vip.leave');
});

//FAQs

Route::get('/faqs', function () {
    return view('faqs'); // Asegúrate de tener el archivo resources/views/faqs.blade.php
})->name('faqs');

//Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');



//rutas cliente y admin area
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(function () {
    Route::get('/cliente-area', [ClienteController::class, 'index'])->name('cliente.area');
    Route::get('/admin-area', [AdminController::class, 'index'])->name('admin.area');
    Route::post('/admin-area/clase/{id}/update', [AdminController::class, 'updateClass'])->name('admin.class.update');

    //deep rutas admin
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // Gestión de usuarios
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Gestión de clases
    Route::post('/admin/classes', [AdminController::class, 'storeClass'])->name('admin.class.store');
    Route::put('/admin/classes/{class}', [AdminController::class, 'updateClass'])->name('admin.class.update');
    Route::delete('/admin/classes/{class}', [AdminController::class, 'destroyClass'])->name('admin.class.destroy');

    Route::post('/admin/classes', [AdminController::class, 'storeClass'])->name('admin.class.store');


    // Ruta para obtener datos de usuario (AJAX)
    Route::get('/admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');

    // Ruta para actualizar usuario
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');

    // Para darse de baja de una clase
    Route::delete('/clases/{class}/unenroll', [ClienteController::class, 'unenroll'])
        ->name('client.class.unenroll');
});


// Ruta para ver la página de suscripciones
Route::get('/subscriptions', function () {
    return view('subscriptions.index');
})->name('subscriptions.index');

// Ruta para actualizar la suscripción después de un pago exitoso
Route::post('/update-subscription', [SubscriptionController::class, 'update'])->name('subscription.update');

Route::get('/subscription', [SubscriptionController::class, 'show'])->name('subscription.view');
Route::post('/subscription/update', [SubscriptionController::class, 'update'])->name('subscription.update');

// Ruta para actualizar la suscripción
Route::get('/stripe/update-subscription', [SubscriptionController::class, 'update'])->name('subscription.update');




Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
