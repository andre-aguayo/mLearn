<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use App\Services\QualificaApiConnectorInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    public function __construct(private QualificaApiConnectorInterface $qualificaApi)
    {
    }

    public function users(): Collection
    {
        return User::get();
    }

    public function store($userRequest): User
    {
        try {
            $user = DB::transaction(function ()  use ($userRequest) {
                $user = User::create([
                    'msisdn' => $userRequest->msisdn,
                    'name' => $userRequest->name,
                    'access_level' => $userRequest->access_level,
                    'password' => Hash::make($userRequest->password),
                    'external_id' => uuid_create()
                ]);

                if (!is_null($user))
                    $this->qualificaApi->createUser($user);

                return $user;
            });

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
