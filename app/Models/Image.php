<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'campaign_id',
    ];

    public function getImageAttribute($value)
    {
        return config('path.campaign') . $value;
    }
}
