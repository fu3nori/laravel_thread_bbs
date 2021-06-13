<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // POSTだったらこっちの処理
        if($request->isMethod('POST'))
        {
            return ('POSTだよー');
        }

        $categorys = DB::table('bbs_categorys')
            ->orderBy('sort', 'desc')
            ->get();
        $categorys = json_decode(json_encode($categorys), true);
        return view('thread_admin.category', compact('categorys'));
    }

}
