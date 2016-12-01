<?php

namespace App\Repositories\User;

use Auth;
use App\Models\User;
use Input;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Mail;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;
    protected $socialAccount;

    public function __construct(User $user, SocialAccount $socialAccount)
    {
        $this->user = $user;
        $this->socialAccount = $socialAccount;
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

    public function getUserLogin($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return $this->user->where('email', $params['email'])->first();
    }

    public function createOrGetUser(ProviderUser $providerUser, $providerName)
    {

        $params = [
            'provider' => $providerName,
            'provider_user_id' => $providerUser->getId(),
        ];

        $account = $this->socialAccount->getUserSocialAccount($params);

        if (!empty($account)) {
            return $account->user;
        } else {
            $account = new $this->socialAccount($params);

            if (!empty($providerUser->getEmail())) {
                $user = $this->user->whereEmail($providerUser->getEmail())->first();
            }

            if (empty($user)) {
                $user = $this->user->create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'avatar' => $providerUser->getAvatar(),
                    'is_active' => config('constants.ACTIVATED'),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}
