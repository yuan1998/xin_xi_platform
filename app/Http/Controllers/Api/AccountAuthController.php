<?php

namespace App\Http\Controllers\Api;

use App\Clients\BaiduClient;
use App\Clients\JlClient;
use App\Clients\KsClient;
use App\Clients\VivoClient;
use App\Http\Controllers\Controller;
use App\Models\BaiduAccount;
use App\Models\BdApp;
use App\Models\JlAccount;
use App\Models\JlApp;
use App\Models\KsAccount;
use App\Models\KsApp;
use App\Models\VivoAccount;
use App\Models\VivoApp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AccountAuthController extends Controller
{

    public function bdAuth(Request $request)
    {
        /**
         * "appId" => "17b6be72a9fe5b397aaeb65bc7bfc52b"
         * "authCode" => "eyJhbGciOiJIUzM4NCJ9.eyJhdWQiOiLotKbmiLfmlbDmja7ph4fpm4YiLCJzdWIiOiJleGMiLCJ1aWQiOjQ2MjIxMzQzLCJhcHBJZCI6IjE3YjZiZTcyYTlmZTViMzk3YWFlYjY1YmM3YmZjNTJiIiwiaXNzIjo ▶"
         * "signature" => "909CF8C4DDF16D5EDCBDE34281D9CE0982B031CD15FA19A690DBE23231381D66C859D6FF7BF0A6C6B112A91DD547A315E5312CAC642192594C7A759BE260D5E5D2D976C507774A2C2D845F6C8A45F98B ▶"
         * "timestamp" => "1681545207399"
         * "userId" => "46221343"
         */
        $all = $request->all();
        $appId = $request->get('appId');
        $code = $request->get('authCode');
        $userId = $request->get('userId');
        if (!$appId || !$code)
            return response([
                'code' => 0,
                'message' => '缺少参数. "appId" "authCode"',
                'data' => $all
            ]);
        $app = BdApp::query()->where('app_id', $appId)->first();
        if (!$app)
            return response([
                'code' => 0,
                'message' => 'AppId参数错误.无法找到对应的',
                'data' => $all
            ]);
        [$errMsg, $tokenResult] = BaiduClient::getAccessToken([
            "authCode" => $code,
            "userId" => $userId,
        ], $app);
        if ($errMsg) {
            return response([
                'code' => 0,
                'message' => $errMsg,
                'data' => $all
            ]);
        }

        [$errMsg, $result] = BaiduClient::getAuthUserInfo($tokenResult);
        if ($errMsg) {
            return response([
                'code' => 0,
                'message' => $errMsg,
                'data' => $all
            ]);
        }
        $subUser = $result['subUserList'];
        $masterUid = $result['masterUid'];
        $data = [
            'masterUId' => $masterUid,
            'username' => $result['masterName'],
            'type' => $result['userAcctType'],
            'targets' => collect($subUser)->map(function ($item) {
                return data_get($item, 'ucName');
            })->join(','),
            'subUserList' => $subUser,
            'authType' => 1,
            'app_id' => $app->id,
            'accessToken' => $tokenResult['accessToken'],
            'refreshToken' => $tokenResult['refreshToken'],
            'expires' => $tokenResult['expiresTime'],
            'refExpires' => $tokenResult['refreshExpiresTime'],
        ];
        BaiduAccount::updateOrCreate([
            'masterUId' => $masterUid
        ], $data);
        return response([
            'code' => 1,
            'message' => '授权成功',
            'userList' => $subUser
        ]);
    }

    public function vivoAuth(Request $request)
    {
        $authCode = $request->get('code');
        $clientId = $request->get('clientId');
        if (!$authCode || !$clientId)
            return response([
                'code' => 0,
                'message' => '缺少参数.',
                'data' => $request->all()
            ]);

        $app = VivoApp::query()->where('client_id', $clientId)
            ->first();
        if (!$app)
            return response([
                'code' => 0,
                'message' => 'ClientId 无法定位App,请确认授权链接.',
                'data' => $request->all()
            ]);
        [$msg, $data] = VivoClient::getAccessToken($authCode, $app);
        if ($msg)
            return response([
                'code' => 0,
                'message' => '获取token失败.',
                'data' => $data
            ]);

        $token = data_get($data, 'access_token');
        [$msg, $info] = VivoClient::getAccountInfo($token);

        if ($msg)
            return response([
                'code' => 0,
                'message' => '获取账户信息失败.',
                'data' => $info
            ]);

        VivoAccount::updateOrCreate([
            'uuid' => $info['uuid']
        ], [
            'username' => $info['companyName'],
            'client_id' => $clientId,
            'access_token' => $token,
            'refresh_token' => $data['refresh_token'],
            'token_date' => Carbon::parse($data['refresh_token_date'] / 1000)->toDateTimeString()
        ]);

        return response([
            'code' => 1,
            'message' => '授权成功',
        ]);

    }

    public function juliangAuth(Request $request)
    {
        $authCode = $request->get('auth_code', null);

        if (!$authCode)
            dd(['msg' => '授权错误.请正确操作', 'data' => $request->all()]);

        $state = json_decode(request()->get('state'), true);

        $appId = data_get($state, 'app_id');
        if (!$appId || !$appModel = JlApp::query()->where('app_id', $appId)->first()) {
            dd(['msg' => '授权错误.不存在的APP ID,请检查您的授权链接']);
        }

        $json = JlClient::getAccessToken($authCode, $appModel);

        if ($json['code'] === 0) {
            dd(
                "OK",
                JlAccount::makeAccount($json['data'], $appModel)
            );
        }

        dd($json);
    }

    public function ksAuth(Request $request)
    {
        $authCode = $request->get('auth_code', null);

        if (!$authCode)
            dd(['msg' => '授权错误.请正确操作', 'data' => $request->all()]);

        $state = json_decode(request()->get('state'), true);
        $appId = data_get($state, 'app_id');
        if (!$appId || !$appModel = ksApp::query()->where('app_id', $appId)->first()) {
            dd(['msg' => '授权错误.不存在的APP ID,请检查您的授权链接']);
        }

        $json = KsClient::getAccessToken($authCode, $appModel);
        $token = data_get($json, 'data.access_token');
        if ($token) {
            $count = KsAccount::makeAccount($json['data'], $appModel);
            dd("授权成功,{$count}");
        }
        dd($json, $request->all());
    }

    public function getBaiduSearchAccount(Request $request)
    {

        $query = BaiduAccount::query()
            ->where('authType', 1);
        if ($id = $request->get('app_id', '')) {
            $id = explode(',', $id);
            $query->whereIn('app_id', $id);
        }
        $accounts = $query->get();
        $result = $accounts->map(function ($account) {
            $token = $account->getOauthToken();

            return [
                "userName" => $account->username,
                "token" => $token,
                'target_ids' => collect($account->subUserList)->pluck('ucId')
            ];
        });

        return response()->json([
            'code' => 0,
            'msg' => null,
            'data' => $result,
        ]);
    }

    public function test()
    {
        BaiduAccount::test();
    }

}
