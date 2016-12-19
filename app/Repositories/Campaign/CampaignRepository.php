<?php
namespace App\Repositories\Campaign;

use Auth;
use Input;
use App\Models\Campaign;
use App\Models\Image;
use App\Models\UserCampaign;
use App\Repositories\BaseRepository;
use App\Repositories\Campaign\CampaignRepositoryInterface;
use DB;
use Illuminate\Container\Container;

class CampaignRepository extends BaseRepository implements CampaignRepositoryInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    function model()
    {
        return Campaign::class;
    }

    public function getAll()
    {
        return $this->model->with('image')
            ->with(['owner.user', 'owner' => function ($query) {
                $query->where('is_owner', config('constants.OWNER'));
            }]);
    }

    public function createCampaign($params = [])
    {
        if (empty($params)) {
            return false;
        }

        DB::beginTransaction();
        try {

            $image = $this->uploadImage($params['image'], config('path.campaign'));

            $campaign = $this->model->create([
                'name' => $params['name'],
                'description' => $params['description'],
                'start_time' => $params['start_date'],
                'end_time' => $params['end_date'],
                'address' => $params['address'],
                'status' => config('constants.NOT_ACTIVE'),
            ]);

            $campaign->image()->create([
                'image' => $image,
            ]);

            $campaign->owner()->create([
                'user_id' => Auth::user()->id,
                'is_owner' => config('constants.OWNER'),
            ]);

            $campaign->save();

            DB::commit();

            return $campaign;
        } catch (Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getDetail($id)
    {
        if (!$id) {
            return false;
        }

        return $this->model->with(['image', 'owner.user', 'comments.user'])
            ->with(['contributions.user', 'contributions' => function ($query) {
                $query->where('status', config('constants.ACTIVATED'));
            }])
            ->find($id);
    }

    public function joinOrLeaveCampaign($params = [])
    {
        if (empty($params)) {
            return false;
        }

        if ($userCampaign = $this->checkUserCampaign($params)) {
            return $userCampaign->delete();
        }

        return UserCampaign::create($params);
    }

    public function checkUserCampaign($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return UserCampaign::where($params)->first();
    }

    public function listCampaignOfUser($userId)
    {
        if (!$userId) {
            return false;
        }

        return $this->model->whereHas('owner', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('is_owner', config('constants.OWNER'));
            });
    }

    public function approveOrRemove($params = [])
    {
        if (empty($params)) {
            return false;
        }

        $userCampaign = $this->checkUserCampaign($params);

        if (empty($userCampaign)) {
            return false;
        }

        if (!$userCampaign->status) {
            // approve
            $userCampaign->status = config('constants.ACTIVATED');
            $userCampaign->save();

            return $userCampaign;
        }

        $userCampaign->status = config('constants.NOT_ACTIVE');
        $userCampaign->save();

        return $userCampaign;
    }
}
