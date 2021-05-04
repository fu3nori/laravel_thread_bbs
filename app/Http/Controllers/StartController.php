<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StartController extends Controller
{
    //index
    public function index(){
        $articles = Article::first()->toArray();
        var_dump($articles);
        echo "<br>---<br>";
        if (Auth::check()) {
            echo "ログインしてます";
        }
        $data = [
            'msg'=>'フォーム入力'
        ];
        return view('/start/index',$data);
    }
    public function post(Request $request){
        $param = ['title' => $request->title,
            'name' => $request->name,
            'text' => $request->text,
        ];
        $validate_rule = [
          'title' =>'required','size:255',
          'name'  =>'required','size:255',
          'text'  =>'required','size:1000',
        ];
        $this->validate($request, $validate_rule);
        DB::insert('insert into articles (title,name,text) values(:title,:name,:text)',$param);
        return view('/start/index', ['msg'=>'正しく入力されました']);
    }

    public function view(){
        $articles = Article::get()->toArray();
        return view('/start/view', compact('articles'));
    }

}
