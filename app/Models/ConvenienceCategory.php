<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConvenienceCategory extends Model
{
    public function viewerInc()
    {
        $this->viewer += 1;
        $this->save();
    }
}
