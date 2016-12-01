<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use App\Repositories\User\UserRepositoryInterface;

class SocialAuthController extends Controller
{
    protected $user;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($providerName)
    {
        try {
            $providerUser = Socialite::driver($providerName)->user();

            if (empty($providerUser)) {
                return redirect('/login');
            }

            $user = $this->userRepository->createOrGetUser($providerUser, $providerName);

            if (empty($user)) {
                return redirect('/login');
            }

            auth()->login($user);

            return redirect('user/' . $user->id);
        }
        catch (\Exception $e) {
            return redirect('/login');
        }
    }

}
