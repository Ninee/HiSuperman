<?php

namespace App\Http\Controllers\Api;

use App\Models\DayRank;
use App\Models\JoinRecord;
use App\Models\MonthRank;
use App\Models\Rank;
use App\Models\Setting;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankController extends Controller
{
    public function index()
    {
//        $update = Rank::whereDate('created_at', date('Y-m-d', time()))->first();
//        $update = Rank::orderBy('id', 'desc')->first();
//        if ($update) {
//            return response()->json([
//                'code' => 0,
//                'data' => $update->rank,
//                'join' => $update->join,
//                'updated_at' => $update->updated_at->toDateTimeString()
//            ]);
//        } else {
//            return response()->json([
//                'code' => 400,
//                'message' => '未上传排行榜数据'
//            ]);
//        }

        $dayRank = DayRank::orderBy('id', 'asc')->get();
        $monthRank = MonthRank::orderBy('id', 'asc')->get();
        $teamLeader = TeamLeader::orderBy('id', 'asc')->get();
        foreach ($monthRank as $key => $item) {
            switch ($key) {
                case 0:
                    $item['rank_text'] = '冠军';
                    break;
                case 1:
                    $item['rank_text'] = '亚军';
                    break;
                case 2:
                    $item['rank_text'] = '季军';
                    break;
            }
        }
        return response()->json([
            'code' => 0,
            'data' => [
                'day' => $dayRank,
                'month' => $monthRank,
                'teamleader' => $teamLeader
            ],
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
    }

    public function total()
    {
        $setting = Setting::orderBy('id', 'desc')->first();
//        $join = JoinRecord::all()->sum('users');
        return response()->json([
            'code' => 0,
            'total' => $setting->base_fans,
        ]);
    }
}
