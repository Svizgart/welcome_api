<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
    ];

    public function events()
    {
        return $this->belongsToMany(
            Event::class,
            'event_participant',
            'participant_id',
            'event_id'
        );
    }
}
