<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware'=>'auth:sanctum'], function(){

Route::get('/boshsahifa',[MainController::class,'polisKiritish']);
// Route::get('/qarzlar',[MainController::class,'qarzdorKiritish'])->name('qarzdorlar');
Route::post('/polisYozish',[MainController::class,'polisYozish']);
Route::post('/qarzdor_qoshish',[MainController::class,'qarzdor_qoshish']);
Route::post('/approve/{id}',[MainController::class,'approve']);
Route::get('/search',[MainController::class,'search']);


});