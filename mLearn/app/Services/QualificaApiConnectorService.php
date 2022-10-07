<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class QualificaApiConnectorService implements QualificaApiConnectorInterface
{

    private array $options;

    private string $baseUri;

    public function __construct()
    {
        $this->options =  [
            'Content-Type' => 'application/json',
            'Authorization' => env('QUALIFICA_AUTHORIZATION'),
            'service-id' => env('QUALIFICA_SERVICE_ID'),
            'app-users-group-id' => env('QUALIFICA_APP_USER_GROUP_ID')
        ];

        $this->baseUri = 'https://api.staging.mlearn.mobi/integrator/qualifica/';
    }

    /**
     * @param User $user
     * @return int response status code
     */
    public function createUser(UserRequest $userRequest): int
    {
        $body = [
            "msisdn" => $userRequest->msisdn,
            "name" => $userRequest->name,
            "access_level" => $userRequest->access_level,
            "password" => $userRequest->password,
            "service_id" => env('QUALIFICA_SERVICE_ID') //Nao consta na documentaçao mas a api retorna erro caso nao tenha
        ];
        $client = Http::withHeaders($this->options)->post($this->baseUri . 'users', $body);

        return json_decode($client->body())['public_id'];
    }

    /**
     * @param int $userId is a external identification od user
     * @return bool status changed?
     */
    public function upgrade(int $userId)
    {
        $this->client->put(
            'users'
        );
        return false;
    }

    /**
     * @param int $userId is a external identification od user
     * @return bool status changed?
     */
    public function downgrade(int $userId)
    {
        $this->client->put(
            'users'
        );
    }
}
