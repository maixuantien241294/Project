<?php

namespace App\Http\Controllers\backend\user;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Session,Redirect,Lang,Sentry;
use Illuminate\Http\Request;
use App\models\backend\User;
use App\models\backend\user\Group;
use App\models\backend\user\UserGroup;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //index
    public function index(){
        return view('backend.users.home.create');
    }
    //create
    public function create(){
        //$group=Group::lists('name','id');
        return view('backend.users.home.create');
    }
    public function store(){
        $rules= [
            'email'                 => 'required|email|max:25|unique:users,email',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'password'              => 'required|min:8|max:20',
            'repassword'            => 'same:password',
        ];
        $validation = \Validator::make(Input::all(), $rules);
        $validation->setAttributeNames(trans('users'));
        if ($validation->fails()) {
            return \Redirect::route('admin.users.create')
                ->withErrors($validation)->withInput();
        }else{
            $user=new User();
            $user->first_name   =   Input::get('first_name');
            $user->last_name    =   Input::get('last_name');
            $user->email        =   Input::get('email');
            $user->password     =   Hash::make(Input::get('password'));
            $user->activated       =   Input::get('status');
            $user->save();
//            $user_group=new UserGroup();
//            $user_group->user_id    =   $user->id;
//            $user_group->group_id   =   Input::get('groups');
//            $user_group->save();
            Session::flash('message', Lang::get('systems.success'));
            Session::flash('alert-class', 'alert-info');
            return Redirect::route('admin.users.index');
        }
    }
}
