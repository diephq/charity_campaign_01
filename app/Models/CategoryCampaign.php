<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryCampaign extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'campaign_id',
        'goal',
    ];

    protected $table = 'categories_campaigns';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
