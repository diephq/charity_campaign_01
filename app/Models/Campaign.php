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

    public $rules = [
        'name' => 'required|max:255',
        'start_date' => 'required|date|date_format:"Y/m/d',
        'end_date' => 'required|date|date_format:"Y/m/d',
        'image' => ['required', 'mimes:jpg,jpeg,JPEG,png,gif', 'max:2024'],
        'address' => 'required',
        'description' => 'required',
    ];

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
}
