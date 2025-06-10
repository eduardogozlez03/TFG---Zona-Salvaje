<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCard extends Model
{
    use HasFactory;

    protected $table = 'home_cards';

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'link',
        'order',
        'category',
        'active',
    ];
}
