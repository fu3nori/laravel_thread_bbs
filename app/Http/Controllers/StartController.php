<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;


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
        return view('start');
    }


}
