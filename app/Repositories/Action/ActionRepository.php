<?php
namespace App\Repositories\Action;

use Auth;
use App\Models\Action;
use App\Repositories\BaseRepository;
use App\Repositories\Action\ActionRepositoryInterface;
use DB;

class ActionRepository extends BaseRepository implements ActionRepositoryInterface
{
    function model()
    {
        return Action::class;
    }

    public function getActionByUser($userId)
    {
        if (!$userId) {
            return false;
        }

        return $this->model->where('user_id', $userId)
            ->orderBy('time', 'desc')
            ->paginate(config('constants.PAGINATE'));
    }
}
