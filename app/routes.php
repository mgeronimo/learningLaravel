<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'UserController@dashboard');
// Confide routes
/*
Route::post( 'user/edit',                 function(){
	$id = Input::get('id');
return View::make(Config::get('confide::edit_form'))->with('id', $id);
});
*/

//Route::get( 'user/edit/',                 function(){

//return View::make('/test');

//});
Route::get( 'user/edit/{id}',                 function($id){
return View::make('edit')->with('id',$id);
//return View::make(Config::get('confide::edit_form'))->with('id', $id);
});

Route::get( 'edituser',                 function(){
	return View::make('edituser');
});

Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');

Route::post( 'user/delete',                 function(){
	$errors="User Deleted .";

$id=Input::get('id');

$user =User::find($id);
$user->delete();
Session::flash('message','Successfully deleted the user.' );
return Redirect::to('edituser');
});






Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'login', ['as' => 'get_login', 'uses' => 'UserController@login']);
Route::post('login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'logout',                 'UserController@logout');

Route::get( 'profile', ['as' => 'get_profile', 'uses' => 'UserController@profile']);
Route::get('create_role' , ['as'=>'get_role','uses'=>'UserController@getRole']);


Route::patch('user/edit/{id}',['as'=>'user.update', 'uses' => 'UserController@edit']);

