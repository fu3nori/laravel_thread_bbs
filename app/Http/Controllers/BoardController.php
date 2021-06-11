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

class BoardController extends Controller
{
    const THREADS_PREVIEW  = "10";// 同時表示スレッド数
    const IMAGE_ONE ="_1"; // 一枚目の投稿画像接尾句
    const IMAGE_TWO ="_2"; // 二枚目の投稿画像接尾句
    //
    public function index($id){
        // 板名取得
        $board = DB::table('bbs_boards')
            ->select('board')
            ->where('id',$id)
            ->first();
        $board_name =$board->board;

        // スレッド一覧取得
        $threads = DB::table('bbs_threads')
            ->where('board_id', $id)
            ->orderBy('updated_at', 'desc')
            ->limit(self::THREADS_PREVIEW)
            ->get();
        $threads = json_decode(json_encode($threads), true);

        $datas = array ();
        // レスポンス一覧取得
        foreach ($threads as $thread)
        {
            $responses = DB::table('bbs_responses')
                ->where('thread_id', '=', $thread['id'])
                ->get();
            $responses = json_decode(json_encode($responses), true);

            $thread['responses']= $responses;
            array_push($datas, $thread);
        }

        return view('/board/index',compact('id', 'datas', 'board_name'));
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
            'ip' => 'required','ip',
            'image1' => 'image|file|mimes:jpeg,png,jpg,gif|max:5120|dimensions:max_width=1600,max_height=1440',
            'image2' => 'image|file|mimes:jpeg,png,jpg,gif|max:5120|dimensions:max_width=1600,max_height=1440',
        ];
        $this->validate($request,$validate_rule);
        // 画像加工開始
        $image_name1 = null;
        $image_name2 = null;
        if ($request->image1 == true){
            $image_name1 = UserFunction::ImageTrance($request->image1, self::IMAGE_ONE);
        }

        if ($request->image2 == true){
            $image_name2 = UserFunction::ImageTrance($request->image2, self::IMAGE_TWO);
        }

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
            $response-> image1 = $image_name1;
            $response-> image2 = $image_name2;
            $response-> thumb1 = $image_name1;
            $response-> thumb2 = $image_name2;
            $response-> ip = $request->ip;
            $response->save();
            // トランザクション終了
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->action('BoardController@index', ['id' =>$request->board_id ]);

    }

    public function res(Request $request){
        $request->merge(['ip' => $_SERVER["REMOTE_ADDR"]]);
        // バリデーション
        $validate_rule = [
            'thread_id' => 'required',
            'name' => 'required','size:255',
            'email' => 'present','email:strict,dns,spoof',
            'response' => 'required','size:2048',
            'ip' => 'required','ip',
            'image1' => 'image|file|mimes:jpeg,png,jpg,gif|max:5120|dimensions:max_width=1600,max_height=1440',
            'image2' => 'image|file|mimes:jpeg,png,jpg,gif|max:5120|dimensions:max_width=1600,max_height=1440',
        ];
        $this->validate($request,$validate_rule);
        // 画像加工開始
        $image_name1 = null;
        $image_name2 = null;
        if ($request->image1 == true){
            $image_name1 = UserFunction::ImageTrance($request->image1, self::IMAGE_ONE);
        }

        if ($request->image2 == true){
            $image_name2 = UserFunction::ImageTrance($request->image2, self::IMAGE_TWO);
        }

        // トランザクション開始
        DB::beginTransaction();
        try {
            // レスポンス書き込み
            $response = new \App\Models\Response;
            $response->	thread_id = $request->thread_id;
            $response->	name = $request->name;
            $response-> email = $request->email;
            $response-> response = $request->response;
            $response-> image1 = $image_name1;
            $response-> image2 = $image_name2;
            $response-> thumb1 = $image_name1;
            $response-> thumb2 = $image_name2;
            $response-> ip = $request->ip;
            $response->save();

            $count = Response::where('thread_id', $request->thread_id)->count();
            // スレッドに件数書き込み
            $thread = new \App\Models\Thread;
            $thread->where('id', $request->thread_id)->update(['writes' => $count]);

            // トランザクション終了
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }


        return redirect()->action('BoardController@index', ['id' =>$request->board_id ]);
    }
}
