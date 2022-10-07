<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    public function users(): Collection;

    public function store($userRequest): User;
}
