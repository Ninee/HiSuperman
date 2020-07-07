<?php

namespace App\Admin\Controllers;

use App\Imports\RankImport;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        //获得请求的方法
        $method = $request->method();

        //post请求则解析文件
        if ($method == 'POST'){

            //按时间命名文件
            $name = time().'.xlsx';

            //文件保存到storage/app/public
            $path = $request->file('upfile')->storeAs('public',$name);

            //获取文件url
            $url = storage_path().'/app/'.$path;

            Excel::import(new RankImport, $url);

            //提示，当然，可以自己用try来处理数据库异常，这里懒得处理了。。。
            $success = new MessageBag([
                'title'   => '恭喜',
                'message' => '导入成功',
            ]);

            return back()->with(compact('success'));

        }

        //如果是get请求，则返回上传页面
        if ($method == 'GET')
        {
            return Admin::content(function (Content $content) {

                $content->header('上传每日排行数据');
                $content->description('导入数据');
                $content->body(view('GlobalUpload'));
            });
        }
    }
}
