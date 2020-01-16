<?php

use Illuminate\Http\Request;

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

Route::resource('films', 'FilmController');
Route::get('films/{film}/inventories', 'InventoryController@index');
Route::post('films/{film}/inventories', 'InventoryController@store');
Route::delete('films/{film}/inventories/{inventory}', 'InventoryController@destroy');
