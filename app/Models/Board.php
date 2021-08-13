<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Board extends Model
{
    //
    protected $table = 'bbs_boards';

    // 実験用コード
    public function getUser(){
        $items = DB::select('select * from users');
        return $items;
    }
}
