<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'user_id',
        'group_id',
    ];

    public function isOwnerCurrentUser()
    {
        return $this->user_id == auth()->id();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
