<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Auth;

class VerifyController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($id, $token)
    {
        $user = $this->userRepository->getUserByToken($id, $token);

        if (empty($user)) {
            return redirect('/register')->withErrors(['error' => trans('message.not_found')]);
        }

        $this->userRepository->verifyUser($user->id);

        if (!Auth::login($user)) {
            return redirect('/');
        } else {
            return redirect()->to(url('/'))->withMessage(trans('user.register.error'));
        }
    }

}
