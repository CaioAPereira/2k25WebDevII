<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array',
        'date' => 'datetime', // <-- Adicione esta linha!
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}