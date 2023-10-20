<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }
}