<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index() {
        $articles = DB::select('select * from articles');
        return view('news', ['articles' => $articles]);  
    }
}
