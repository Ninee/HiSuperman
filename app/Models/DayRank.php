<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DayRank extends Model
{
    public function getIconAttribute($icon)
    {
        if (url()->isValidUrl($icon) || strpos($icon, 'data:image') === 0) {
            $src = $icon;
        } else {
            $src = Storage::disk(config('admin.upload.disk'))->url($icon);
        }
        return $src;
    }
}
