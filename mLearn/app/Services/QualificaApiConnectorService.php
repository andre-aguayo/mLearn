<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class QualificaApiConnectorService implements QualificaApiConnectorInterface
{

    /**
     * @param Guzzle guzzle client
     */
    private Client $client;

    public function __construct()
    {
        //Options for qualifica api
        $options = [
            'base_uri' => 'https://api.staging.mlearn.mobi/integrator/qualifica/users',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => env('QUALIFICA_AUTHORIZATION'),
                'service-id' => env('QUALIFICA_SERVICE_ID'),
                'app-users-group-id' => env('QUALIFICA_APP_USER_GROUP_ID'),
            ]
        ];
        //Guzzle client
        $this->client = new Client($options);
    }

    public function createUser(User $user)
    {

        $user->makeVisible('password');

        $response = $this->client->post(
            '/users',
            ['body' => $user->toJson()]
        );
    }
}
