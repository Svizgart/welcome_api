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

    public function participant()
    {
        return $this->belongsToMany(
            Participant::class,
            'event_participant',
            'event_id',
            'participant_id'
        );
    }
}
