<?php

namespace App\Repositories\User;

use App\Models\Campaign;
use App\Models\UserCampaign;
use Auth;
use App\Models\User;
use Input;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Mail;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use DB;
use Illuminate\Container\Container;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    protected $container;
    protected $socialAccount;

    public function __construct(Container $container, SocialAccount $socialAccount)
    {
        parent::__construct($container);
        $this->socialAccount = $socialAccount;
    }

    function model()
    {
        return User::class;
    }

    public function register($data = [])
    {
        $email = $data['email'];

        $params = [
            'name' => $data['name'],
            'email' => $email,
            'password' => $data['password'],
        ];

        $user = $this->model->create($params);

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
        return $this->model->where(['id' => $id, 'token_verification' => $token])->first();
    }

    public function verifyUser($id)
    {
        $user = $this->model->find($id);

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

        return $this->model->where('email', $params['email'])->first();
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
                $user = $this->model->whereEmail($providerUser->getEmail())->first();
            }

            if (empty($user)) {
                $user = $this->model->create([
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

    public function updateProfile($inputs, $id)
    {
        if (empty($id) || empty($inputs)) {
            return false;
        }

        if (empty($inputs['avatar'])) {
            unset($inputs['avatar']);
        } else {
            $avatar = $this->uploadImage($inputs['avatar'], config('path.to_avatar'));
            $inputs['avatar'] = $avatar;
        }

        DB::beginTransaction();
        try {
            $user = $this->model->where('id', $id)->update($inputs);
            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getUsersInCampaign($campaignId)
    {
        if (!$campaignId) {
            return false;
        }

        $campaign = Campaign::with('userCampaigns')->find($campaignId);

        $userIds = [];
        foreach ($campaign->userCampaigns as $userCampaign) {
            if ($userCampaign->is_owner == config('constants.NOT_OWNER')) {
                $userIds [] = $userCampaign->user_id;
            }
        }

        return $this->model->whereIn('id', $userIds)
            ->with(['userCampaign' => function ($query) use ($campaignId) {
                $query->where('campaign_id', $campaignId);
            }])
            ->orderBy('id', 'desc');
    }
}
