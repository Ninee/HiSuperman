<?php
/**
 * Created by PhpStorm.
 * User: hirsi
 * Email: whuanxu@163.com
 * Github: https://github.com/Ninee
 * Date: 2020/7/9
 * Time: 8:45 AM
 */
if (! function_exists('trans_img_url')) {

    /**
     * 图片地址转换为绝对路径
     * @param $path
     * @return mixed
     */
    function trans_img_url($path) {
        if (url()->isValidUrl($path) || strpos($path, 'data:image') === 0) {
            $src = $path;
        } else {
            $src = Storage::disk(config('admin.upload.disk'))->url($path);
        }
        return $src;
    }
}