<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class UserRegisterController extends Controller
{
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $user;
    protected $userRepository;

    /**
     * UserRegisterController constructor.
     * @param User $user
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(User $user, UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, $this->user->rules);

        $user = $this->userRepository->register($request->all());

        if (empty($user)) {
            return redirect('/register')->withErrors(['error'=> trans('user.register.error')]);
        }

        return redirect('/login')
            ->with(['alert-success' => trans('user.please_verify_email')]);

    }

}
