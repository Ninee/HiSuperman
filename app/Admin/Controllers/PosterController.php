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


use App\Models\ConvenienceInfo;

class PosterController
{

    public function convenienceInfo($info_id)
    {
        $info = ConvenienceInfo::find($info_id);
        return view('convenience.poster', ['info' => $info]);
    }
}