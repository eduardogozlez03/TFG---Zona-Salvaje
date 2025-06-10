<?php

namespace Database\Seeders;

use App\Models\TrainingCard;
use Illuminate\Database\Seeder;

class TrainingCardSeeder extends Seeder
{
    public function run()
    {
        TrainingCard::create([
            'title' => 'Body Combat',
            'description' => 'Body Combat es una clase basada en movimientos de artes marciales.',
            'image_url' => 'https://i.imgur.com/AeEYt8E.jpeg',
            'category' => 'cardio',
            'duration' => 45,
            'intensity' => 'Alta'
        ]);

        TrainingCard::create([
            'title' => 'Body Dance',
            'description' => 'Body Dance combina música y movimientos de baile para un entrenamiento divertido.',
            'image_url' => 'https://i.imgur.com/CJ7um5W.jpeg',
            'category' => 'cardio',
            'duration' => 50,
            'intensity' => 'Media'
        ]);

        TrainingCard::create([
            'title' => 'Body Training',
            'description' => 'Ejercicios de fuerza y resistencia.',
            'image_url' => 'https://i.imgur.com/yZROZps.jpeg',
            'category' => 'cardio',
            'duration' => 60,
            'intensity' => 'Alta'
        ]);

        TrainingCard::create([
            'title' => 'Body Fight',
            'description' => 'Técnicas de combate inspiradas en artes marciales.',
            'image_url' => 'https://i.imgur.com/vYwTuEk.jpeg',
            'category' => 'cardio',
            'duration' => 45,
            'intensity' => 'Alta'
        ]);
    }
}
