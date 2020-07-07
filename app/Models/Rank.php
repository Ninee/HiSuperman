<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Rank extends Model
{
    protected $fillable = ['rank', 'join'];

    public function getRankAttribute($rank)
    {
        return json_decode($rank, true);
    }

    public function getJoinAttribute($join)
    {
        return json_decode($join, true);
    }

    public function paginate()
    {
        $result = file_get_contents(env('APP_URL') . '/api/rank');

        $result = json_decode($result, true);

        extract($result);

        if ($code == 400) {
            $data = ['name' => '未上传数据'];
        }

        $rank = static::hydrate($data);

        $paginator = new LengthAwarePaginator($rank, count($rank), count($rank));

        $paginator->setPath(url()->current());

        return $paginator;
    }
}
