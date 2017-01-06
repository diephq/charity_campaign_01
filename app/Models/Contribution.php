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

    public function categoryContributions()
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

    public function actions()
    {
        return $this->morphMany(Action::class, 'actionable');
    }

    public function campaign($id)
    {
        return Campaign::with('image')
            ->with('owner.user')
            ->find($id);
    }
}
