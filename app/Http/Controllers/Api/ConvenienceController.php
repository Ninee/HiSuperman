<?php

namespace App\Http\Controllers\Api;

use App\AdminUser;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvenienceController extends Controller
{
    public function index(Request $request)
    {
        $admin = AdminUser::where(['name' => $request->city])->first();
        $category = ConvenienceCategory::where(['name' => $request->category])->first();
        $dayRange = $request->input('dayRange', '');

        $list = ConvenienceInfo::where(['user_id' => $admin->id, 'convenience_category_id' => $category->id])
            ->when($dayRange, function ($query) use ($dayRange) {
                if (count($dayRange) == 1) {
                    $date = Carbon::createFromTimestampMs($dayRange[0]);
                    return $query->whereBetween('created_at', [$date->format('Y-m-d 00:00:00'), $date->addDay(1)->format('Y-m-d 00:00:00')]);
                }
                if (count($dayRange) == 2) {
                    return $query->whereBetween('created_at', [Carbon::createFromTimestampMs($dayRange[0])->toDateTimeString(), Carbon::createFromTimestampMs($dayRange[1])->addDay(1)->toDateTimeString()]);
                }
            })
            ->orderByDesc('created_at')
            ->with('user')
            ->paginate($request->input('page_size', 10));
        return response()->json($list);
    }
}
