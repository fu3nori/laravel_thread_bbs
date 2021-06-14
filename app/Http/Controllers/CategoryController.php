<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;


class CategoryController extends Controller
{
    //
    public function index(){

        $categorys = Category::OrderBy('sort', 'asc')->get();
        return view('/category/index',compact('categorys'));
    }

    public function view($id){
        $boards = Board::where("category_id", $id)->OrderBy('sort', 'asc')->get();

        return view('/category/view',compact('boards'));
    }

}
