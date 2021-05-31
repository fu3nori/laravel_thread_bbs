<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;


class CategoryController extends Controller
{
    //
    public function index(){
        $categorys = Category::all();
        return view('/category/index',compact('categorys'));
    }

}
