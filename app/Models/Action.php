<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'actionable_id',
        'actionable_type',
        'action_type',
        'time',
    ];

    /**
     * Get all of the owning actionable models.
     */
    public function actionable()
    {
        return $this->morphTo();
    }
}
