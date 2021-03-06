<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// TODO: turn jwt middleware back on after audience issue is solved
//Route::resource('films', 'FilmController')->middleware('jwt');
Route::resource('films', 'FilmController');
Route::get('films/{film}/inventories', 'InventoryController@index');
Route::post('films/{film}/inventories', 'InventoryController@store');
Route::delete('films/{film}/inventories/{inventory}', 'InventoryController@destroy');
Route::get('films/{film}/reviews', 'ReviewController@index');
Route::post('films/{film}/reviews', 'ReviewController@store');
Route::delete('films/{film}/reviews/{review}', 'ReviewController@destroy');
