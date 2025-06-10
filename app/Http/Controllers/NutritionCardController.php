<?php

namespace App\Http\Controllers;

use App\Models\NutritionCard;
use Illuminate\Http\Request;

class NutritionCardController extends Controller
{
    public function index()
    {
        $nutritionCards = NutritionCard::all();
        return view('nutrition', compact('nutritionCards'));
    }
}

