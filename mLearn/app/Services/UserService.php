<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function users(): Collection
    {
        return User::get();
    }

    public function store($userRequest): User
    {
        return User::create([
            'msisdn' => $userRequest->msisdn,
            'name' => $userRequest->name,
            'access_level' => $userRequest->access_level,
            'password' => Hash::make($userRequest->password),
            'external_id' => uuid_create()
        ]);
    }
}
