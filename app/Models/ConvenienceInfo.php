<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvenienceInfo extends Model
{
    public function setPicturesAttribute($pictures)
    {
        if (is_array($pictures)) {
            $this->attributes['pictures'] = json_encode($pictures);
        }
    }

    public function getPicturesAttribute($pictures)
    {
        return json_decode($pictures, true);
    }
}
