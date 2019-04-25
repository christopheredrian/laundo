<?php

namespace Tests\Feature\Models;


use Tests\Utilities\OAuthUtilities;
use Tests\TestCase;
use Tests\Utilities\TestConfig;

class OauthTest extends TestCase
{

    /**
     * @test
     * @group unit
     */
    public function getTokenTest()
    {


        $oauthClient = OAuthUtilities::getOAuthClient("Laundo Password Grant Client");


        /**
         * Note that the APP_URL on config must be set correctly
         *  http://localhost:8000 or
         *  http://laundo.test
         */
        $response = $this->json('post', 'oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oauthClient->id,
            // Fetch from DB
            'client_secret' => $oauthClient->secret,
            'username' => TestConfig::SUPERADMIN_EMAIL,
            'password' => TestConfig::SUPERADMIN_PASSWORD,
            'scope' => '*',
        ]);

        /**
         * Use code below if wanted to use Guzzle
         */
        /*$http = new GuzzleHttp\Client();
        $response = $http->post('http://laundo.test/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                // Fetch from DB
                'client_secret' => '7OvQUNKNgxyEoL8KPYuPdUXnTk5BZee0oYAMHJDW',
                'username' => 'sa@laundo.com',
                'password' => 'superadmin',
                'scope' => '*',
            ]
        ]);*/


        $this->assertEquals(200, $response->getStatusCode());
        $jsonString = $response->getContent();
        $jsonArray = json_decode($jsonString, true);

    }

}