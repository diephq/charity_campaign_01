<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'campaign_id',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedules::class);
    }
}
