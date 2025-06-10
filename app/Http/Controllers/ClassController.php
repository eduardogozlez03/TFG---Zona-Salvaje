<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::with('admin')->get(); // Asegúrate que 'admin' esté definida en el modelo
        $classes = ClassModel::with(['instructor', 'users'])->get();

        return view('vip', compact('classes'));
    }


    public function join($id)
    {
        $class = ClassModel::findOrFail($id);
        $user = Auth::user();

        // Verifica si ya está inscrito
        if ($user->classes->contains($id)) {
            return back()->with('info', 'Ya estás inscrito en esta clase.');
        }

        // Verifica si hay plazas
        if ($class->users->count() >= $class->capacity) {
            return back()->with('error', 'No quedan plazas disponibles.');
        }

        // Inscribir
        $class->users()->attach($user->id);

        return back()->with('success', 'Te has inscrito correctamente.');
    }

    public function leave($id)
    {
        $class = ClassModel::findOrFail($id);
        $user = Auth::user();

        // Verifica si está inscrito
        if (! $user->classes->contains($id)) {
            return back()->with('info', 'No estás inscrito en esta clase.');
        }

        // Eliminar inscripción
        $class->users()->detach($user->id);

        return back()->with('success', 'Has anulado tu participación.');
    }
}
