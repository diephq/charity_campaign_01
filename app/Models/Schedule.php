<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'name',
        'description',
        'event_id',
        'start_time',
        'end_time',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
