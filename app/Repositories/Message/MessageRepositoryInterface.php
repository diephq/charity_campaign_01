<?php
namespace App\Repositories\Message;

interface MessageRepositoryInterface
{
    public function createMessage($inputs);

    public function getMessagesByGroupId($groupId);
}
