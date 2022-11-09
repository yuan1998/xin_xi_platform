<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

trait HasAccountToken {

    public $tokenKey = 'token_id';
    public $token = null;

    public function getToken() {
        return self::getTokenCache($this[$this->tokenKey]);
    }


    public static function saveTokenCache(array $data, $key = null)
    {
        $key = $key ?: self::generateTokenKey();

        Cache::put($key, json_encode($data));
        return [$key, $data];
    }

    abstract public function refreshToken();

    public function getAccessToken()
    {
        $token = $this->checkTokenIsExpires();
        if (!$token) {
            return $this->refreshToken();
        }
        return $token;
    }

    public function checkTokenIsExpires()
    {
        $token = $this->getToken();
        $refreshToken = data_get($token, 'refresh_token');
        $tokenExpires = data_get($token, 'expires_in');
        if ($refreshToken && $tokenExpires) {
            $time = Carbon::parse($tokenExpires)->addHours(-6);
            if ($time->gte(now())) {
                return data_get($token , 'access_token');
            }
        }
        return null;
    }


    public static function generateTokenKey()
    {
        return Str::uuid();
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function getTokenCache($key)
    {
        $cacheJson = Cache::get($key);
        return json_decode($cacheJson, true);
    }

}
