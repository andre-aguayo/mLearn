<?php

namespace App\Services;

use App\EnumTypes\AccessLevelType;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @param string $userId is a external_id
     * @return User
     */
    public function findUserByExternalId(string $userId): User | null;

    /**
     * @param string $usephonerId is a user phone number
     * @return User
     */
    public function findUserByMsisdn(string $phone): User | null;

    /**
     * @return Collection[Users] get all users
     */
    public function users(): Collection;

    /**
     * @param UserRequest $userRequesr
     * @return User
     */
    public function store(UserRequest $userRequest): User;

    /**
     * @param User $user is a external identification od user
     * @param AccessLevelType $toAccessLevel is a access change
     * @return bool status changed?
     */
    public function changeAccessLevel(
        User $user,
        AccessLevelType $toAccessLevel
    ): bool;
}
