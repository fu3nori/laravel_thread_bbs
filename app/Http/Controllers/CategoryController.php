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
    public function index($id){

        $categorys = Category::all();
        return view('/category/index',compact('categorys'));
    }

    public function view($id){
        var_dump($id);
        $data = null;
        return view('/category/view',compact('data'));
    }

}
