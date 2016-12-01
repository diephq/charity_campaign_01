<?php

namespace App\Repositories\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

interface UserRepositoryInterface
{
    public function register($data = []);
    public function getUserByToken($id, $token);
    public function verifyUser($id);
    public function getUserLogin($params = []);
    public function createOrGetUser(ProviderUser $providerUser, $providerName);
}
