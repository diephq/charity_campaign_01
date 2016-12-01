<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider_user_id',
        'provider',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserSocialAccount($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return SocialAccount::where('provider', $params['provider'])
            ->where('provider_user_id', $params['provider_user_id'])
            ->with('user')
            ->first();
    }
}
