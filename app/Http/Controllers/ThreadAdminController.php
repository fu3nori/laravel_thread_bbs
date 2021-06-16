<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Board;
use App\Models\Thread;
use App\Models\Response;

class ThreadAdminController extends Controller
{
    // ユーザーロール認証
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('/thread_admin.index');
    }

    public function category(Request $request)
    {
        $msg = "カテゴリー管理";

        // カテゴリー新規作成
        if($request->isMethod('POST') && $request['method'] == 'insert')
        {

            // カテゴリー名バリデーション
            $validate_rule = [
                'category' => 'required','size:255',
                'sort' => 'integer',
            ];
            $this->validate($request,$validate_rule);
            // カテゴリ書き込み
            $category = new \App\Models\Category;
            $category->category = $request->category;
            $category->sort = $request->sort;
            $category->save();
            $msg=$request->category.'追加完了';
        }
        // カテゴリ削除
        if($request->isMethod('POST') && $request['delete'] == 1)
        {
            // カテゴリーIDバリデーション
            $validate_rule = [
                'category' => 'required',
                'id' => 'required','size:255','integer',
            ];
            $this->validate($request,$validate_rule);
            DB::table('bbs_categorys')->where('id', $request->id)->delete();
            $msg=$request->category.'削除完了';
        }
        // カテゴリ編集
        if($request->isMethod('POST') && $request['delete'] != 1 && $request['method'] != 'insert')
        {
            $category_key = 'category'.$request['id'];
            $sort_key = 'sort'.$request['id'];
            // カテゴリー編集バリデーション
            $validate_rule = [
                $category_key => 'required','size:255',
                $sort_key => 'integer',
            ];
            $this->validate($request,$validate_rule);
            // カテゴリ編集
            DB::table('bbs_categorys')->where('id', $request->id)
                ->update(['category' => $request->$category_key,
                    'sort'=>$request->$sort_key]);
            $msg='編集完了';
        }

        $categorys = DB::table('bbs_categorys')
            ->orderBy('sort', 'desc')
            ->get();
        $categorys = json_decode(json_encode($categorys), true);
        return view('thread_admin.category', compact('categorys','msg'));
    }
    public function board(Request $request){
        $msg = "カテゴリー別板追加";

        // 板新規作成
        if($request->isMethod('POST') && $request['method'] == 'insert')
        {
            // 板情報バリデーション
            $validate_rule = [
                'board' => 'required','size:255',
                'sort' => 'integer'
            ];
            $this->validate($request,$validate_rule);
            // カテゴリ書き込み
            $board = new \App\Models\board;
            $board->category_id = $request->category_id;
            $board->board = $request->board;
            $board->sort = $request->sort;
            $board->save();
            $msg=$request->board.'追加完了';
        }
        // 板削除
        elseif($request->isMethod('POST') && $request['method'] == 'delete')
        {
            $param = [
                'id' => $request->id
            ];
            DB::delete('DELETE `bbs_boards` , `bbs_threads` , `bbs_responses`
            from bbs_boards LEFT JOIN bbs_threads ON bbs_boards.id = bbs_threads.board_id
            RIGHT JOIN bbs_responses ON bbs_responses.thread_id = bbs_threads.id
            where bbs_boards.id =:id', $param);

            /**
            DELETE `bbs_boards` , `bbs_threads` , `bbs_responses`
            from `bbs_boards` LEFT JOIN `bbs_threads` ON `bbs_boards`.`id` = `bbs_threads`.`board_id`
            RIGHT JOIN `bbs_responses` ON `bbs_responses`.`thread_id` = `bbs_threads`.`id` where `bbs_boards`.`id`=10;
            **/


            $msg=$request->board.'削除完了';
        }

        // 板一覧取得
        $boards = DB::table('bbs_boards')->orderBy('sort', 'desc')->get();
        $boards = json_decode(json_encode($boards), true);

        // セレクトボタン生成
        $lists = Category::pluck('category', 'id');
        return view('thread_admin.board', compact('boards','lists',  'msg'));
    }

    public function thread(Request $request)
    {
        $msg = "スレッド管理";
        if($request->isMethod('POST'))
        {
            // スレッド・レス削除
            $param = [
                'id' => $request->id
            ];
            DB::delete('DELETE  `bbs_threads` , `bbs_responses`
            from bbs_threads LEFT JOIN bbs_responses ON bbs_threads.id = bbs_responses.thread_id
            where bbs_threads.id =:id', $param);
            $msg = $request->thread.'を削除しました';
        }

        $threads = DB::table('bbs_boards')
            ->leftJoin('bbs_threads', 'bbs_boards.id', '=', 'bbs_threads.board_id')
            ->orderBy('bbs_threads.board_id', 'desc')
            ->get();
        $threads = json_decode(json_encode($threads), true);

        return view('thread_admin.thread',compact('threads', 'msg'));
    }
    public function threadres($id)
    {
        $msg = 'スレッド配下レス削除';
        // スレッド取得
        // スレッドタイトル・カウント取得
        $thread = DB::table('bbs_threads')
            ->where('id', $id)
            ->select('id','board_id','thread', 'writes')
            ->first();
        $thread = json_decode(json_encode($thread), true);

        // レスポンス取得
        $responses = DB::table('bbs_responses')
            ->where('thread_id', $id)
            ->get();
        $responses = json_decode(json_encode($responses), true);
        return view('/thread_admin/threadres' , compact('id','thread','responses', 'msg'));
    }
    public function deleteres(Request $request)
    {
        // 書き込み削除
        // 残りレス件数チェック

        $res_count = Response::where('thread_id', $request->thread_id)->get()->count();


        // 残り件数が1だったらレス削除と共にスレッドも削除してメニューに遷移
        if ($res_count == 1){
            // トランザクション開始
            DB::beginTransaction();
            try {

                // スレッド削除
                Thread::where('id', $request->thread_id)->delete();
                // レスポンス削除
                Response::where('id',$request->response_id)->delete();
                    // トランザクション終了
                    DB::commit();
                } catch (\Exception $e) {
                DB::rollback();
            }
            $msg = '該当スレッドの書き込みは全て無くなったのでレスとスレッドが削除されました';
            return view('/thread_admin/index',compact('msg'));
        } else {
            //レスポンス削除
            Response::where('id',$request->response_id)->delete();
            $msg = 'レスを削除しました';
            return view('/thread_admin/index',compact('msg'));
        }
        return ("削除完了");
    }
}
