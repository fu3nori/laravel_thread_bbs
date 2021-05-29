<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $articles = Article::simplePaginate(5);
        $msg = 'フォーム入力';
        return view('/admin/index', compact('articles','msg'));
    }

    public function edit(Request $request)
    {
        $param = [
            'id' => $request->id,
            'title' => $request->title,
            'name' => $request->name,
            'text' => $request->text,
        ];
        $validate_rule = [
            'id' => 'required',
            'title' => 'required', 'size:255',
            'name' => 'required', 'size:255',
            'text' => 'required', 'size:1000',
        ];
        $this->validate($request, $validate_rule);
        DB::table('articles')->where('id', $request->id)
            ->update(['title' => $request->title,
                'name'=>$request->name,
                'text'=>$request->text]);
        $msg='編集完了';

        $articles = Article::simplePaginate(5);
        return view('/admin/index', compact('articles','msg'));
    }

}
