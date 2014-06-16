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


Route::get( 'user/edit/{id}',                 function($id){

if (Auth::check()){

	return View::make('edit')->with('id',$id);
}
else
{
	$logmsg="Please log in first.";
	return View::make('login')->with('success', $logmsg);
}

	});



Route::get( 'deluser/{id}',                 function($id){

if (Auth::check()){

	return View::make('deluser')->with('id',$id);
}
else
{
	$logmsg="Please log in first.";
	return View::make('login')->with('success', $logmsg);
}


});



Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');

Route::post( 'user/delete',                 function(){


	$errors="User Deleted .";
$id=Input::get('hide');
$user =User::find($id);

$assigned = Assigned::where('user_id', $id)->first();
$assigned->delete();
$user->delete();
Session::flash('message','Successfully deleted the user.' );
return Redirect::to('/');

});





Route::get( 'user/create',                 'UserController@create')->before('auth');
Route::post('user',                        'UserController@store');
Route::get( 'login', ['as' => 'get_login', 'uses' => 'UserController@login']);
Route::post('login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'logout',                 'UserController@logout')->before('auth');


Route::get('create_role' , ['as'=>'get_role','uses'=>'UserController@getRole']);


Route::patch('user/edit/{id}',['as'=>'user.update', 'uses' => 'UserController@edit'])->before('auth');

