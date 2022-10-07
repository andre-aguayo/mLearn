<?php

namespace App\Services;

use App\Models\User;

interface QualificaApiConnectorInterface
{
    public function createUser(User $user);
}
