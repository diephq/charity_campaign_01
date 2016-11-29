<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryContribution extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'contribution_id',
    ];
}
