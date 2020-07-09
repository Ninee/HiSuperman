<?php

namespace App\Http\Controllers;

use App\AdminUser;
use App\Models\City;
use App\Models\ConvenienceCategory;
use Illuminate\Http\Request;

class ConvenienceController extends Controller
{
    public function index($city = 1, $category = 1)
    {
        $cities = City::all()->pluck('name')->toArray();
        $categories = ConvenienceCategory::all()->pluck('name')->toArray();
        return view('convenience.index', [
            'cities' => json_encode($cities),
            'categories' => json_encode($categories),
            'currentCity' => AdminUser::find($city),  //以站点运营管理员作为城市id
            'currentCategory' => ConvenienceCategory::find($category)
        ]);
    }
}
