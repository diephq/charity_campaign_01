<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'start_time',
        'end_time',
        'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function owner()
    {
        return $this->hasOne(UserCampaign::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function userCampaigns()
    {
        return $this->hasMany(UserCampaign::class);
    }

    public function categoryCampaign()
    {
        return $this->hasMany(CategoryCampaign::class);
    }
}
