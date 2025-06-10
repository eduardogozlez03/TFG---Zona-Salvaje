<?php

namespace App\Http\Controllers;

use App\Models\HomeCard;

class HomeController extends Controller
{

    public function index()
    {
        $cardsPrimero = HomeCard::where('category', 'primero')->where('active', 1)->orderBy('order')->get();
        $cardsSegundo = HomeCard::where('category', 'segundo')->where('active', 1)->orderBy('order')->get();

        return view('home', compact('cardsPrimero', 'cardsSegundo'));
    }
}
