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

Route::get('/', function()
{
    return View::make('layout');
});

Route::filter('csrf', function () 
{
	if (Request::forged()) {
		return Response::error('500');
	}
});

Route::group(array('prefix' => 'service'), function() 
{
    Route::resource('body-style', 'VehicleBodyStyleController');
    Route::resource('make', 'VehicleMakeController');
    Route::post('authentication/login', 'AuthenticationController@login');
	Route::get('authentication/logout', 'AuthenticationController@logout');
});

App::missing(function($exception)
{
    return View::make('layout');
});