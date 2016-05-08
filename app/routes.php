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

Route::get('/', function () {
    return View::make('layout');
});

Route::filter('csrf', function () {
    if (Request::forged()) {
        return Response::error('500');
    }
});

Route::group(array('prefix' => 'v1'), function () {
    Route::post('authentication/login', 'AuthenticationController@login');
    Route::get('authentication/logout', 'AuthenticationController@logout');
    Route::resource('body-style', 'VehicleBodyStyleController');
    Route::post('upload-body-style', 'VehicleBodyStyleController@upload');
    Route::resource('make', 'VehicleMakeController');
    Route::post('upload-make-brand', 'VehicleMakeController@upload');
    Route::resource('model', 'VehicleModelController');
    Route::resource('model-series', 'VehicleModelSeriesController');
    Route::resource('vehicle', 'VehicleController');
    Route::post('upload-vehicle', 'VehicleController@upload');
    Route::resource('feature-category', 'VehicleFeatureCategoryController');
    Route::resource('feature', 'VehicleFeatureController');
});

App::missing(function ($exception) {
    return View::make('layout');
});
