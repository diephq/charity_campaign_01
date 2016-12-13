<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'name',
        'email',
        'text',
    ];

    public $rules = [
        'name' => 'max:255',
        'email' => 'email|max:255',
        'text' => 'required|max:255',
        'campaign_id' => 'required|numeric|exists:campaigns,id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
