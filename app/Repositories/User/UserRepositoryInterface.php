<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function register($data = []);
    public function getUserByToken($id, $token);
    public function verifyUser($id);
    public function getUserLogin($params = []);
}
