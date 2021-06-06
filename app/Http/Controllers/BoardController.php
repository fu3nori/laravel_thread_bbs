<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Table;

class BoardController extends Controller
{
    const THREADS_PREVIEW  = "10";
    //
    public function index($id){
        // スレッド一覧取得
        $threads = DB::table('bbs_threads')
            ->orderBy('updated_at', 'desc')
            ->limit(self::THREADS_PREVIEW)
            ->get();

        // レスポンス一覧取得
        foreach ($threads as $thread)
        {
            $thread_collection = $thread;
            $responses = DB::table('bbs_responses')
                ->where('thread_id', '=', $thread->id)
                ->get();
var_dump($responses);
        }

        return view('/board/index',compact('id' ));
    }
    public function post(Request $request){
        // IP取得
        $request->merge(['ip' => $_SERVER["REMOTE_ADDR"]]);


        // バリデーション
        $validate_rule = [
            'thread' => 'required','size:255',
            'name' => 'required','size:255',
            'email' => 'present','email:strict,dns,spoof',
            'response' => 'required','size:2048',
            'ip' => 'required','ip'
        ];
        $this->validate($request,$validate_rule);
        // トランザクション開始
        DB::beginTransaction();
        try {
            // スレッド書き込み
            $thread = new \App\Models\Thread;
            $thread->thread = $request->thread;
            $thread->board_id = $request->board_id;
            $thread->ip = $request->ip;
            $thread->save();

            // レスポンス書き込み
            $thread_id = $thread->id;
            $request->merge(['thread_id' => $thread_id]);
            $response = new \App\Models\Response;
            $response->	thread_id = $thread_id;
            $response->	name = $request->name;
            $response-> email = $request->email;
            $response-> response = $request->response;
            $response-> ip = $request->ip;
            $response->save();
            // トランザクション終了
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->action('BoardController@index', ['id' =>$request->board_id ]);

    }
}
