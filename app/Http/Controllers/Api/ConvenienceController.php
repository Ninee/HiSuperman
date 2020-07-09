<?php

namespace App\Http\Controllers\Api;

use App\AdminUser;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvenienceController extends Controller
{
    public function index(Request $request)
    {
        $admin = AdminUser::where(['name' => $request->city])->first();
        $category = ConvenienceCategory::where(['name' => $request->category])->first();
        $list = ConvenienceInfo::where(['user_id' => $admin->id, 'convenience_category_id' => $category->id])
            ->orderByDesc('created_at')
            ->paginate($request->input('page_size', 10));
        return response()->json($list);
    }
}
