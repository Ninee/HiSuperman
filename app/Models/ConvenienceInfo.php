<?php

namespace App\Models;

use App\AdminUser;
use Illuminate\Database\Eloquent\Model;

class ConvenienceInfo extends Model
{
    public function user()
    {
        return $this->belongsTo(AdminUser::class, 'user_id', 'id');
    }
    public function setPicturesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['pictures'] = json_encode($pictures);
        }
    }

    public function getPicturesAttribute($pictures)
    {
        $pictures = json_decode($pictures, true);
        $tmp = [];
        if (is_array($pictures)) {
            foreach ($pictures as $picture) {
                array_push($tmp, trans_img_url($picture));
            }
        }
        return $pictures ? $tmp : $pictures;
    }
}
