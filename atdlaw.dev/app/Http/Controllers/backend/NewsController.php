<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\models\backend\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //index
    public function index(){

    }
    public function create(){
        return view('backend.news.create');
    }
}
