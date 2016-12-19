<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Auth;
use App\Repositories\Campaign\CampaignRepositoryInterface;
use App\Models\Campaign;

class UserController extends Controller
{
    protected $user;
    protected $userRepository;
    protected $campaignRepository;

    public function __construct(User $user, UserRepositoryInterface $userRepository,
                                CampaignRepositoryInterface $campaignRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
        $this->campaignRepository = $campaignRepository;
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

        if (!$user->isCurrent()) {
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

        if (!$user->isCurrent()) {
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

    public function listUserCampaign($id)
    {
        try {
            $user = $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        // get list user's campaign
        $campaigns = $this->campaignRepository->listCampaignOfUser($id)->paginate(config('constants.PAGINATE'));

        return view('user.campaigns', compact('user', 'campaigns'));
    }

    public function manageCampaign($id, $campaignId)
    {
        try {
            $user = $this->user->findOrFail($id);
            $campaign = Campaign::findOrFail($campaignId);
        } catch (ModelNotFoundException $e) {
            return abort(404);
        }

        // Get users joined
        $campaignUsers = $this->userRepository->getUsersInCampaign($campaignId)->paginate(config('constants.PAGINATE'));

        return view('user.campaign_detail', compact('user', 'campaign', 'campaignUsers'));
    }
}
