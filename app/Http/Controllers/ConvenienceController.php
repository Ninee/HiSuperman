<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Models\City;
use App\Models\ConvenienceCategory;
use Illuminate\Http\Request;

class ConvenienceController extends Controller
{
    public function index($city = 2, $category = 1)
    {
        $app = \EasyWeChat::officialAccount();
//        $app ='';
        $cities = City::all()->pluck('name')->toArray();
        $categories = ConvenienceCategory::all()->pluck('name')->toArray();
        return view('convenience.index', [
            'app' => $app,
            'cities' => json_encode($cities),
            'categories' => json_encode($categories),
            'currentCity' => AdminUser::find($city),  //以站点运营管理员作为城市id
            'currentCategory' => ConvenienceCategory::find($category)
        ]);
    }
}
