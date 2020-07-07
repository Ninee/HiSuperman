<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamLeader extends Model
{
    public function getThumbAttribute($icon)
    {
        if (url()->isValidUrl($icon) || strpos($icon, 'data:image') === 0) {
            $src = $icon;
        } else {
            $src = Storage::disk(config('admin.upload.disk'))->url($icon);
        }
        return $src;
    }
}
