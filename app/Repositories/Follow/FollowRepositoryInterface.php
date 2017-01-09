<?php
namespace App\Repositories\Follow;

interface FollowRepositoryInterface
{
    public function followOrUnFollowUser($targetId);

    public function getFollowUser($targetId);

    public function following($userId);

    public function followers($userId);
}
