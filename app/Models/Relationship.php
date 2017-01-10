<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'target_id',
        'target_type',
        'status',
    ];

    public function following()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
