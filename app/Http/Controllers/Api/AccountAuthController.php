<?php

namespace App\Http\Controllers\Api;

use App\Clients\JlClient;
use App\Clients\KsClient;
use App\Clients\VivoClient;
use App\Http\Controllers\Controller;
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
        if (!$appId || !$appModel = JlApp::query()->where('app_id' ,$appId)->first()) {
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

    public function ksAuth(Request  $request) {
        $authCode = $request->get('auth_code', null);

        if (!$authCode)
            dd(['msg' => '授权错误.请正确操作', 'data' => $request->all()]);

        $state = json_decode(request()->get('state'), true);
        $appId = data_get($state, 'app_id');
        if (!$appId || !$appModel = ksApp::query()->where('app_id' ,$appId)->first()) {
            dd(['msg' => '授权错误.不存在的APP ID,请检查您的授权链接']);
        }

        $json = KsClient::getAccessToken($authCode, $appModel);
        $token = data_get($json , 'data.access_token');
        if ($token) {
            $count = KsAccount::makeAccount($json['data'],$appModel);
            dd("授权成功,{$count}");
        }

        dd($json,$request->all());
    }

}
