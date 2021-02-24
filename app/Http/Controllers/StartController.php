<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class StartController extends Controller
{
    //index
    public function index(){
        $articles = Article::first();
        var_dump($articles);

        return view('start');
    }
}
