<?php

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


Route::group([
    'prefix' => 'insurance',
    'namespace' => 'Insurance',
    'middleware' => 'api',
], function () {
    Route::get('/insurances', 'IndexController')->name('insurance');
    Route::post('/store', 'StoreController')->name('store');
    Route::post('/update', 'UpdateController')->name('update');
});


Route::group([
    'namespace' => 'General',
    'middleware' => 'api',
], function () {
    Route::get('/countries', 'CountryController')->name('countries');
});
