<?php
namespace App\Repositories\Action;

interface ActionRepositoryInterface
{
    public function getActionByUser($userId);
}
