<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    const TARGET_CONVENIENCE = 'convenience';
    const TARGET_CONVENIENCE_FEED = 'convenience_feed';

    protected $fillable = [
        'url', 'target', 'event', 'data', 'ua', 'ip'
    ];

    public function setDataAttribute($data) {
        $this->attributes['data'] = json_encode($data);
    }
    public function getDataAttribute($data) {
        return json_decode($data, true);
    }

}
