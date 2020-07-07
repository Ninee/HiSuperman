<?php

namespace App\Imports;

use App\Models\JoinRecord;
use App\Models\Rank;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GradeImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $joinStart = false;
        $joinEnd = false;
        $groupGradeStart = false;
        $groupGradeEnd = false;
        $join = [];
        $groupGrade = [];

        $flag = false;//个人绩效统计开始标志
        $rank = [];
        //TODO::组的数据统计
        foreach ($collection as $row) {
            $arr = $row->toArray();

            if ($arr[2] === '总绩效') {
                //部门加人结束
                $joinEnd = true;
                //部门绩效开始
                $groupGradeStart = true;
            }

            //统计加人
            if ($joinStart && !$joinEnd) {
                array_push($join, [
                    'name' => $arr[0],
                    'value' => $arr[2],
                ]);
            }

            //
            if ($groupGradeStart && !$groupGradeEnd) {

            }

            if ($arr[2] === '总加人') {
                $joinStart = true;
            }
            //统计绩效排行
            if ($flag) {
                //过滤无效数据
                if (($arr[1] !== null) && ($arr[2] !== null)) {
                    array_push($rank, [
                        'name' => $arr[1],
                        'value' => $arr[2]
                    ]);
                }
            };
            if ($arr[3] == '排名') {
                $flag = true;
            }
        }
        $gradeArr = [];
        foreach($rank as $key => $v){
            $gradeArr[$key]['value'] = $v['value'];
        }
        array_multisort($gradeArr, SORT_DESC, $rank);
        //排名,同分数,同名次
        $place = 1;
        foreach ($rank as $key => $v) {
            $rank[$key]['rank'] = $place;
            if ($key + 1 < count($rank) && $rank[$key + 1]['value'] !== $v['value']) $place++;
        }
        //排行榜
        $update = Rank::whereDate('created_at', date('Y-m-d', time()))->first();
        if ($update) {
            $update->rank = json_encode($rank);
            $update->join = json_encode($join);
            $update->save();
        } else {
            Rank::updateOrCreate([], [
                'rank' => json_encode($rank),
                'join' => json_encode($join),
            ]);
        }

        $joinSum = 0;

        //新增人数记录
        foreach ($join as $value) {
            $joinSum += $value['value'];
        }
        $joinRecord = JoinRecord::whereDate('created_at', date('Y-m-d', time()))->first();
        if ($joinRecord) {
            $joinRecord->users = $joinSum;
            $joinRecord->save();
        } else {
            JoinRecord::create([
                'users' => $joinSum
            ]);
        }

    }
}
