<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign_id',
        'user_id',
        'name',
        'email',
        'count',
        'description',
        'status',
    ];

    public $rules = [
        'name' => 'max:255',
        'email' => 'email|max:255|unique:users',
        'campaign_id' => 'required|numeric|exists:campaigns,id',
    ];

    public function categoryContribution()
    {
        return $this->hasMany(CategoryContribution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($contribution) {
            $contribution->status = config('constants.NOT_ACTIVE');
        });
    }
}
