<?php
namespace App\Repositories\Follow;

use Auth;
use App\Models\Relationship;
use App\Repositories\BaseRepository;
use App\Repositories\Follow\FollowRepositoryInterface;
use DB;

class FollowRepository extends BaseRepository implements FollowRepositoryInterface
{

    function model()
    {
        return Relationship::class;
    }

    public function followOrUnFollowUser($targetId)
    {
        if (!$targetId) {
            return false;
        }

        $follow = $this->getFollowUser($targetId);

        if ($follow) {
            $follow->status = $follow->status ? config('constants.NOT_ACTIVE') : config('constants.ACTIVATED');
            $follow->save();

            return $follow;
        }

        return $this->model->create([
            'user_id' => auth()->id(),
            'target_id' => $targetId,
            'target_type' => config('constants.FOLLOW_USER'),
            'status' => config('constants.ACTIVATED'),
        ]);
    }

    public function getFollowUser($targetId)
    {
        if (!$targetId) {
            return false;
        }

        return $this->model->where('user_id', auth()->id())
            ->where('target_id', $targetId)
            ->where('target_type', config('constants.FOLLOW_USER'))
            ->first();
    }
}
