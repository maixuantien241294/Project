<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
//    //protected $layout    ="frontend.layout.master";
    public function index(){
        return view('frontend.layout.master');
    }
}
