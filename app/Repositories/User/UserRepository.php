<?php

namespace App\Repositories\User;

use Auth;
use App\Models\User;
use Input;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Mail;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($data = [])
    {
        $email = $data['email'];

        $params = [
            'name' => $data['name'],
            'email' => $email,
            'password' => $data['password'],
        ];

        $user = $this->user->create($params);

        if (empty($user)) {
            return false;
        }

        Mail::queue('email.register', [
            'name' => $data['name'],
            'link' => route('verification', [$user->id, $user->token_verification]),
        ], function ($message) use ($email) {
            $message->to($email)->subject(trans('email.subject'));
        });

        return $user;
    }

    public function getUserByToken($id, $token)
    {
        return $this->user->where(['id' => $id, 'token_verification' => $token])->first();
    }

    public function verifyUser($id)
    {
        $user = $this->user->find($id);

        $user->is_active = config('constants.ACTIVATED');
        $user->token_verification = '';
        $user->save();

        return $user;
    }

}
