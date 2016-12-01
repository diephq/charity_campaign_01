<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class UserLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $user;
    protected $userRepository;

    public function __construct(User $user, UserRepositoryInterface $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, $this->user->loginRules);

        $user = $this->userRepository->getUserLogin($request->all());

        if (empty($user)) {
            return redirect('login')->withErrors(trans('user.not_found'));
        }

        if (empty($user->is_active)) {
            return redirect()->to('/login')->withErrors(trans('user.not_active'));
        }

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], $request->get('remember'))) {
            return redirect('home');
        }

        return redirect('login')->withErrors(trans('user.login_fail'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
