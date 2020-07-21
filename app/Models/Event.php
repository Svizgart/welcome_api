<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'date',
        'address',
        'description'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
