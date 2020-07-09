<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use App\Models\Statistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{

    public function store(Request $request)
    {
        $request->setTrustedProxies($request->getClientIps());
        $ip = $request->getClientIp();

        $data  =  $request->all();
        $data['ip'] = $ip;
        Statistic::create($data);
        if ($data['target'] == Statistic::TARGET_CONVENIENCE) {
            City::where(['name' => $data['data']['city']])->first()->viewerInc();
            ConvenienceCategory::where(['name' => $data['data']['category']])->first()->viewerInc();
        }
        if ($data['target'] == Statistic::TARGET_CONVENIENCE_FEED) {
            $feed = ConvenienceInfo::find($data['data']['id']);
            if ($data['event'] == 'copy') {
                $feed->copyerInc();
            }
            if ($data['event'] == 'share') {
                $feed->sharerInc();
            }
        }
        return response()->json([
            'code' => 0,
            'message' => 'success'
        ]);
    }
}
