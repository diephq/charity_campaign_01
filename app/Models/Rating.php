<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'star',
        'target_id',
        'target_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
