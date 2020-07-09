<?php
/**
 * Created by PhpStorm.
 * User: hirsi
 * Email: whuanxu@163.com
 * Github: https://github.com/Ninee
 * Date: 2020/7/8
 * Time: 3:21 AM
 */

namespace App\Admin\Controllers;


use App\Models\ConvenienceCategory;
use App\Models\ConvenienceInfo;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PosterController
{

    public function convenienceInfo($info_id)
    {
        $info = ConvenienceInfo::find($info_id);
        $category = ConvenienceCategory::find($info->convenience_category_id);
        $qrcode = QrCode::format('png')->margin(1)->size(258)->generate(env('APP_URL') . '/convenience/' . $info->user_id . '/' . $category->id);
        return view('convenience.new_poster', ['info' => $info, 'category' => $category, 'qrcode' => base64_encode($qrcode)]);
    }
}