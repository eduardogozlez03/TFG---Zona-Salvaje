<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NutritionCardSeeder extends Seeder
{
    public function run()
    {
        DB::table('nutrition_cards')->insert([
            // Nutrición Deportiva
            [
                'title' => 'Dieta atletas resistencia',
                'description' => 'Nutrición dedicada a atletas y alto rendimiento.',
                'image_url' => 'https://i.imgur.com/example1.jpeg',
                'category' => 'deportiva',
                'type' => 'resistencia',
                'calories' => 2500,
                'nutrients' => 'Proteína, Carbohidratos, Grasas Saludables',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta atletas de fuerza',
                'description' => 'Dieta ideal para aumentar fuerza y masa muscular.',
                'image_url' => 'https://i.imgur.com/example2.jpeg',
                'category' => 'deportiva',
                'type' => 'fuerza',
                'calories' => 3000,
                'nutrients' => 'Proteína Alta, Carbohidratos Complejos, Grasas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta atletas híbridos',
                'description' => 'Una dieta para atletas que combinan resistencia y fuerza.',
                'image_url' => 'https://i.imgur.com/example3.jpeg',
                'category' => 'deportiva',
                'type' => 'híbridos',
                'calories' => 2800,
                'nutrients' => 'Proteína, Carbohidratos, Grasas Balanceadas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Nutrición Terapéutica
            [
                'title' => 'Dieta anti diabetes',
                'description' => 'Si sufres diabetes, esta es tu dieta.',
                'image_url' => 'https://i.imgur.com/example4.jpeg',
                'category' => 'terapeutica',
                'type' => 'diabetes',
                'calories' => 1800,
                'nutrients' => 'Fibra Alta, Carbohidratos Complejos, Grasas Saludables',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta anti colesterol',
                'description' => 'Para controlar tu colesterol de manera saludable.',
                'image_url' => 'https://i.imgur.com/example5.jpeg',
                'category' => 'terapeutica',
                'type' => 'colesterol',
                'calories' => 2000,
                'nutrients' => 'Omega 3, Grasas No Saturadas, Fibra',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta anti hipertensión',
                'description' => 'Controla tu presión arterial con esta dieta.',
                'image_url' => 'https://i.imgur.com/example6.jpeg',
                'category' => 'terapeutica',
                'type' => 'hipertensión',
                'calories' => 1900,
                'nutrients' => 'Potasio, Fibra, Grasas Saludables',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Nutrición por Etapa de Vida
            [
                'title' => 'Dieta 15-30 años',
                'description' => 'Dieta adecuada para jóvenes y adultos jóvenes.',
                'image_url' => 'https://i.imgur.com/example7.jpeg',
                'category' => 'etapa_vida',
                'type' => '15-30',
                'calories' => 2500,
                'nutrients' => 'Proteína, Vitaminas, Minerales',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta 30-50 años',
                'description' => 'Nutrición adecuada para adultos en su mejor etapa.',
                'image_url' => 'https://i.imgur.com/example8.jpeg',
                'category' => 'etapa_vida',
                'type' => '30-50',
                'calories' => 2200,
                'nutrients' => 'Fibra, Antioxidantes, Proteína',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Dieta 50-80 años',
                'description' => 'Dieta ideal para adultos mayores.',
                'image_url' => 'https://i.imgur.com/example9.jpeg',
                'category' => 'etapa_vida',
                'type' => '50-80',
                'calories' => 2000,
                'nutrients' => 'Calcio, Vitamina D, Omega 3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
