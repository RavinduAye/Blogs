<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $userData)
    {
        return User::create($userData);
    }

    public function createToken($user)
    {
        return $user->createToken('MyApp')->accessToken;
    }

    public function getUser($userId)
    {
        return User::with('blogPosts')->find($userId);
    }

}
