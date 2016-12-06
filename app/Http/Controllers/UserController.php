<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Auth;

class UserController extends Controller
{
    protected $user;
    protected $userRepository;

    public function __construct(User $user, UserRepositoryInterface $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        if ($user->isCurrent()) {
            return redirect(action('UserController@show', ['id' => $user->id]));
        }

        return view('user.detail', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        if ($user->isCurrent()) {
            return redirect(action('UserController@show', ['id' => $user->id]));
        }

        $this->validate($request, $this->user->updateRules($id));

        $params = [
            'id' => $user->id,
            'name' => $user->name = $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'avatar' => $request->file('avatar')
        ];

        // update user
        $user = $this->userRepository->updateProfile($params, $id);

        if (empty($user)) {
            return redirect(action('UsersController@show', ['id' => $id]))
                ->withErrors(['message' => trans('user.update_error')])
                ->withInput();
        }

        return redirect()->back()
            ->with(['alert-success' => trans('user.update_success')]);

    }

}
