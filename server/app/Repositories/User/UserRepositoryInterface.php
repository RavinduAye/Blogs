<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function createUser(array $userData);
    
    public function createToken($user);
}