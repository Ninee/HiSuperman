<?php
/**
 * Created by PhpStorm.
 * User: hirsi
 * Email: whuanxu@163.com
 * Github: https://github.com/Ninee
 * Date: 2020/4/24
 * Time: 5:06 PM
 */

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\URL;

/**
 * 全局上传数据按钮
 */

class GlobalUploadButton extends AbstractTool
{
    protected $url;

    public function __construct()
    {
        $this->url = URL::current().'/upload';
    }

    public function render()
    {
        $options = [
            $this->url   => '导入数据',
        ];

        return view('tools.GlobalUploadButton', compact('options'));
    }
}