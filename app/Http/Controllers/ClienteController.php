<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ClienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $classes = $user->classes;

        return view('area_cliente', compact('user'));
    }

// app/Http/Controllers/ClienteController.php


    public function unenroll(ClassModel $class)
    {
        $user = Auth::user();
        if (!$user->classes()->where('class_id', $class->id)->exists()) {
            return back()->with('error', 'No estás inscrito en esta clase.');
        }
        $user->classes()->detach($class->id);
        return back()->with('success', 'Te has dado de baja de la clase correctamente.');
    }
    
}
