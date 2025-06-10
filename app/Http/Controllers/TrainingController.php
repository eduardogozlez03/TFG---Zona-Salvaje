<?php

namespace App\Http\Controllers;

use App\Models\TrainingCard;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        // Recuperamos todas las cards de la base de datos
        $trainingCards = TrainingCard::all();
        return view('training', compact('trainingCards'));
    }
}
