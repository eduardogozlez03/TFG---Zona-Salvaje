<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCardsTable extends Migration
{
    public function up()
    {
        Schema::create('home_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image_url');
            $table->string('link')->nullable(); // Para que puedan redirigir
            $table->integer('order')->default(0); // Orden en el home
            $table->string('category')->nullable(); // Opcional: “banner”, “promo”, etc.
            $table->boolean('active')->default(true); // Por si quieres ocultarlas sin borrarlas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_cards');
    }
}
