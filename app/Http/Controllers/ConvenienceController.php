<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Models\City;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConvenienceController extends Controller
{
    public function index($city = 2, $category = 1)
    {
        $app = \EasyWeChat::officialAccount();
        $cities = City::where(['is_qrcode' => 1])->pluck('name')->toArray();
        $adminUser = AdminUser::find($city);
        $categories = ConvenienceCategory::all()->pluck('name')->toArray();
        $tops = ConvenienceInfo::where(['user_id' => $adminUser->id])->where('is_top', 1)->orderBy('id', 'desc')->get();
        return view('mobile.convenience.index', [
            'app' => $app,
            'tops' => $tops,
            'cities' => json_encode($cities),
            'categories' => json_encode($categories),
            'currentCity' => $adminUser,  //以站点运营管理员作为城市id
            'currentCategory' => ConvenienceCategory::find($category)
        ]);
    }

    //分享页面
    public function share($info_id)
    {
        $info = ConvenienceInfo::find($info_id);
        $category = ConvenienceCategory::find($info->convenience_category_id);
        $qrcode = QrCode::format('png')->margin(1)->size(258)->generate(env('APP_URL') . '/convenience/detail/' . $info_id);
        return view('mobile.convenience.share', ['info' => $info, 'category' => $category, 'qrcode' => base64_encode($qrcode)]);
    }

    public function detail($info_id)
    {
        $info = ConvenienceInfo::find($info_id);
        $category = ConvenienceCategory::find($info->convenience_category_id);
        return view('mobile.convenience.detail', ['info' => $info, 'category' => $category]);
    }
}
