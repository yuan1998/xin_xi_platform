<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\HttpCode;
use App\Models\BaiduAccount;
use App\Models\JlAccount;
use App\Models\KsAccount;
use App\Models\TxAccount;
use App\Models\UcAccount;
use App\Models\VivoAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PullDataController extends Controller
{
    const ACTION_LIST = ['all', 'jl', 'ks', 'tx', 'uc', 'bd', 'vivo'];

    public function pullData(Request $request): \Illuminate\Http\JsonResponse
    {
        $action = $request->get('action');
        if (!in_array($action, self::ACTION_LIST)) {
            return response()->json([
                'code' => HttpCode::BadRequest,
                'message' => 'Action 参数不合法.',
            ]);
        }

        $startDate = $request->get('start_date');
        if (!validateDate($startDate)) {
            return response()->json([
                'code' => HttpCode::BadRequest,
                'message' => '开始日期错误或者不存在',
            ]);
        }

        $endDate = $request->get('end_date');
        if (!validateDate($endDate)) {
            return response()->json([
                'code' => HttpCode::BadRequest,
                'message' => '结束日期错误或者不存在'
            ]);
        }
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        if ($startDate->gt($endDate)) {
            return response()->json([
                'code' => HttpCode::BadRequest,
                'message' => '结束日期不能在开始日期之前'
            ]);
        }

        $data = [];
        switch ($action) {
            case "ks":
                $data = KsAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString());
                break;
            case "jl" :
                $data = JlAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString());
                break;
            case "tx" :
                $data = TxAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString());
                break;
            case "uc" :
                $data = UcAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString());
                break;
            case "bd" :
                $data = BaiduAccount::getOauthAccountReportData($startDate->toDateString(), $endDate->toDateString(),2276038);
                break;
            case "vivo" :
                $data = VivoAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString());
                break;

            case "all":
                $data = [
                    KsAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString()),
                    JlAccount::getAccountReportData($startDate->toDateString(), $endDate->toDateString())
                ];
                break;
        }


        return response()->json([
            'code' => HttpCode::OkRequest,
            'data' => $data,
            'message' => 'OK'
        ]);


    }

}
