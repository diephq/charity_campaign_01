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
}
