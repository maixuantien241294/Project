<?php

namespace App\Http\Controllers\backend;
use Illuminate\Http\Request;
use App\models\backend\User;
use Illuminate\Support\Facades\Input;
use Session,Redirect,Lang,Sentry;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public function getLogin(){
        return view('backend.login.layout');
    }
    public function postLogin(){
        $rules =[
            'email'     => 'required|email',
            'password'  => 'required',
        ];
        $validation = \Validator::make(Input::all(), $rules);
        $validation->setAttributeNames(trans('users'));
        if ($validation->fails()) {
            return \Redirect::route('backend.login')
                ->withErrors($validation)->withInput();
        }else{
            $email=Input::get('email');
            $password=Input::get('password');

            try
            {
                // Login credentials
                $credentials = array(
                    'email'    => $email,
                    'password' => $password,
                );

                // Authenticate the user
                Sentry::authenticate($credentials, false);
                //remmeber
                if(Input::get('remmember')=='on'){

                    Sentry::authenticateAndRemember($credentials);
                }
            }
            catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                $errors = new \Illuminate\Support\MessageBag;
                $errors->add('invalid', "This user hasn't been activated. Please contact us for support.");

                return Redirect::route('backend.login')->withErrors($errors)->withInput();
            } catch (\Exception $e) {
                $errors = new \Illuminate\Support\MessageBag;
                $errors->add('invalid', "Oops, your email or password is incorrect.");

                return Redirect::route('backend.login')->withErrors($errors)->withInput();

            }
            Session::put('email',$email);
            return Redirect::route('admin.users.index');
        }
    }
    public function getLogout(){
        Sentry::logout();
        return Redirect::route('admin.categories.index');
    }
    public function getUnauthorized(){
        return view('backend.pages.unauthorized');
    }
}
