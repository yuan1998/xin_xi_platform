<?php

namespace App\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class BaseClient
{
    public static $client;


    public static function getClient(): Client
    {
        if (!self::$client) {
            $jar = new \GuzzleHttp\Cookie\CookieJar();

            self::$client = new Client([
                'cookies' => $jar,
                'timeout' => 60,
                'verify' => false,
                'headers' => [
                    'Content-type'=> 'application/json',
                    'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Mobile Safari/537.36 Edg/94.0.992.31',
                    'x-requested-with' => 'XMLHttpRequest'
                ]
            ]);
        }

        return self::$client;
    }


    /**
     * @throws GuzzleException
     */
    public static function post($url, $config = []): ResponseInterface
    {
        $client = self::getClient();
        return $client->post($url, $config);
    }

    /**
     * @throws GuzzleException
     */
    public static function get($url, $config = []): ResponseInterface
    {
        $client = self::getClient();
        return $client->get($url, $config);
    }
}
