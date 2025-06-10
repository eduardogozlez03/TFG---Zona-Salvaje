<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainingCard;


class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'admin_id',
        'class_date',
        'capacity',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id')->withTimestamps();
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function trainingCard()
    {
        return $this->belongsTo(\App\Models\TrainingCard::class, 'training_card_id');
    }
}
