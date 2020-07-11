<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Models\City;
use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConvenienceController extends Controller
{
    public function index($city = 2, $category = 1)
    {
//        $app = \EasyWeChat::officialAccount();
        $app = '';
        $cities = City::all()->pluck('name')->toArray();
        $categories = ConvenienceCategory::all()->pluck('name')->toArray();
        return view('mobile.convenience.index', [
            'app' => $app,
            'cities' => json_encode($cities),
            'categories' => json_encode($categories),
            'currentCity' => AdminUser::find($city),  //以站点运营管理员作为城市id
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
