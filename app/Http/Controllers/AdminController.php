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
        $data = [
            'msg'=>'フォーム入力'
        ];
        return view('/admin/index', $data);
    }

}
