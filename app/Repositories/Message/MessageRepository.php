<?php
namespace App\Repositories\Message;

use Auth;
use App\Models\Message;
use App\Repositories\BaseRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use DB;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    function model()
    {
        return Message::class;
    }

    public function createMessage($inputs)
    {
        if (empty($inputs)) {
            return false;
        }

        $fillable = $this->model->getFillable();
        $inputs = array_only($inputs, $fillable);

        return $this->model->create($inputs);
    }

    public function getMessagesByGroupId($groupId)
    {
        return $this->model->where('group_id', $groupId)->get();
    }
}
