<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\ClientController@index');

Route::prefix('client')->group(function () {
    Route::post('/store', 'App\Http\Controllers\ClientController@store');
    
    Route::get('{client}', 'App\Http\Controllers\ClientController@get');
    Route::post('{client}/clear', 'App\Http\Controllers\ClientController@clear');
    Route::post('{client}/new-number', 'App\Http\Controllers\ClientController@newNumber');
});

Route::prefix('number')->group(function () {
    Route::post('{number}/top-up-balance', 'App\Http\Controllers\NumberController@topUpBalance');
});
