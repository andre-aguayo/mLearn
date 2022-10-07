<?php

namespace App\Services;

use App\Http\Requests\UserRequest;

interface QualificaApiConnectorInterface
{
    /**
     * @param UserRequest $userRequest
     * @return int response status code
     */
    public function createUser(UserRequest $userRequest): int;

    /**
     * @param int $userId is a external identification od user
     * @return bool status changed?
     */
    public function upgrade(int $userId);

    /**
     * @param int $userId is a external identification od user
     * @return bool status changed?
     */
    public function downgrade(int $userId);
}
