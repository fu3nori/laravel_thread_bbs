<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Library\UserFunction; // ユーザー関数呼出　2021/06/10

class ThreadController extends Controller
{
    //
    public function list($id)
    {
        // スレッドが無かったら404
        $count = DB::table('bbs_threads')->where('board_id', $id)->count();
        if($count ==0)
        {
            return \App::abort(404);
            exit;
        }


        $threads = DB::table('bbs_threads')
            ->where('board_id',$id)
            ->orderBy('updated_at', 'desc')
            ->get();
        $threads = json_decode(json_encode($threads), true);
        return view('/thread/list', compact('threads'));
    }

    public function view($id, $bbs_responses_id=null)
    {
        // スレッドが無かったら404
        $count = DB::table('bbs_threads')->where('id', $id)->count();
        if($count ==0)
        {
            return \App::abort(404);
            exit;
        }

        // スレッドタイトル・カウント取得
        $thread = DB::table('bbs_threads')
            ->where('id', $id)
            ->select('id','board_id','thread', 'writes')
            ->first();
        $thread = json_decode(json_encode($thread), true);

        // レス番指定
        if ($bbs_responses_id != null){
            $responses = DB::table('bbs_responses')
                ->where('id', $bbs_responses_id)
                ->get();
            $responses = json_decode(json_encode($responses), true);

        } else {
            // レスポンス取得
            $responses = DB::table('bbs_responses')
                ->where('thread_id', $id)
                ->get();
            $responses = json_decode(json_encode($responses), true);

        }





        return view('/thread/view', compact('thread','responses'));
    }

    public function post(Request $request)
    {

    }

}
