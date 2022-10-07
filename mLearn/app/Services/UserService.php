<?php

namespace App\Services;

use App\EnumTypes\AccessLevelType;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use App\Services\QualificaApiConnectorInterface;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    public function __construct(private QualificaApiConnectorInterface $qualificaApi)
    {
    }

    /**
     * @param string $userId is a external identification od user
     * @return User | null if non exists
     */
    public function findUserByExternalId(string $userId): User | null
    {
        return User::where(["external_id" => $userId])->first();
    }

    /**
     * @param string $usephonerId is a user phone number
     * @return User | null if non exists
     */
    public function findUserByMsisdn(string $phone): User | null
    {
        return User::where(["msisdn" => $phone])->first();
    }

    /**
     * @return Collection[Users] get all users
     */
    public function users(): Collection
    {
        return User::get();
    }

    /**
     * 
     * @param UserRequest $userRequest
     * @return User
     */
    public function store(UserRequest $userRequest): User
    {
        try {
            $user = DB::transaction(function ()  use ($userRequest) {
                if (!is_null($this->findUserByMsisdn($userRequest->msisdn)))
                    throw new Exception('Este telefone já esta cadastrado.');

                $publicId = $this->qualificaApi->createUser($userRequest);

                $user = User::create([
                    'msisdn' => $userRequest->msisdn,
                    'name' => $userRequest->name,
                    'access_level' => $userRequest->access_level,
                    'password' => Hash::make($userRequest->password),
                    'external_id' => uuid_create(),
                    'public_id' => $publicId
                ]);

                return $user;
            });

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function changeAccessLevel(
        User $user,
        AccessLevelType $toAccessLevel
    ): bool {
        try {
            $user = DB::transaction(function ()  use ($user, $toAccessLevel) {
                //call api to change
                if ($toAccessLevel == AccessLevelType::PRO)
                    $e = 1;
                $changed = $this->qualificaApi->downgrade($user->external_id);

                $changed = $this->qualificaApi->upgrade($user->external_id);

                //Update user access level
                if ($changed) {
                    $user->access_level = $toAccessLevel;
                    return $user->save();
                }
            });

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
