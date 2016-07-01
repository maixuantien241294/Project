<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//frontend
Route::get('/',['as'=>'frontend.home','uses'=>'frontend\HomeController@index']);
//backend
Route::group(['prefix'=>'admin'],function(){
   Route::group([],function(){
       Route::get('/', function() {
           return Redirect::route('backend.login');
       });
       Route::get('/login', array('as' => 'backend.login', 'uses' => 'backend\HomeController@getLogin'));

       Route::group(['middleware'=>['csrf']],function(){
           Route::post('/login',['as'=>'backend.postLogin','uses'=>'backend\HomeController@postLogin']);
       });
   });
    Route::group(['middleware' => ['sentry']],function(){
        Route::get('elfinder/ckeditor4', 'Barryvdh\Elfinder\ElfinderController@showCKeditor4');

        Route::get('/', ['as' => 'admin.home', 'role' => ['backend'], 'uses' => 'backend\HomeController@index']);
        Route::get('/unauthorized', ['as' => 'backend.unauthorized', 'role' => ['backend'], 'uses' => 'backend\HomeController@getUnauthorized']);
        //news
        Route::resource('news','backend\NewsController');
        //group
        Route::group(['prefix' => 'users', 'namespace' => 'backend\user'], function() {
            Route::get('groups/updatePermission/{id}', ['as' => 'admin.users.groups.updatePermission', 'role' => ['admin.users.groups.create', 'admin.users.groups.update'], 'uses' => 'GroupsController@updatePermission']);
            Route::get('groups/delete/{id}', ['as' => 'admin.users.groups.delete', 'role' => ['admin.users.groups.destroy'], 'uses' => 'GroupsController@delete']);
            Route::resource('groups', 'GroupsController');
        });

        Route::get('users/change_password/{id}', ['as' => 'admin.users.change_password', 'role' => ['admin.users.update'], 'uses' => 'Backend\User\HomeController@changePassword']);
        Route::put('users/post_change_password/{id}', ['as' => 'admin.users.change_password_put', 'role' => ['admin.users.update'], 'uses' => 'Backend\User\HomeController@postChangePassword']);

        Route::get('users/delete/{id}', ['as' => 'admin.users.delete', 'role' => ['admin.users.destroy'], 'uses' => 'Backend\User\HomeController@delete']);
        Route::resource('users', 'Backend\User\HomeController');
        Route::get('/logout', array('as' => 'backend.logout', 'role' => ['backend'], 'uses' => "Backend\HomeController@getLogout"));
    });

});