<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Board;

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

        // カテゴリー新規作成
        if($request->isMethod('POST') && $request['method'] == 'insert')
        {
            // カテゴリー名バリデーション
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




        // 板一覧取得
        $boards = DB::table('bbs_boards')->orderBy('sort', 'desc')->get();
        $boards = json_decode(json_encode($boards), true);

        // セレクトボタン生成
        $lists = Category::pluck('category', 'id');
        return view('thread_admin.board', compact('boards','lists',  'msg'));
    }

}
