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
        return ("管理人です");
    }

}
