<?php
/**
 * Created by PhpStorm.
 * User: hirsi
 * Email: whuanxu@163.com
 * Github: https://github.com/Ninee
 * Date: 2018/3/20
 * Time: 下午3:30
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;
use Illuminate\Support\Facades\Storage;

class DragUploader extends Field
{
    protected $view = 'admin.drag-uploader';

    protected static $css = [
        'vendor/drag-uploader/upload.css',
    ];

    protected static $js = [
        'vendor/drag-uploader/jQuery.upload.js',
    ];

    public function render()
    {
        $this->script = <<<EOT
$("#{$this->id}").upload(
    function(_this,data){
        alert('放大镜功能暂时未开放')
    }
)
EOT;
        return parent::render(); // TODO: Change the autogenerated stub
    }

}