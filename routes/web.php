<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Authcontroller;
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




    
Route::resource('/projet', ProjectController::class);




// routes walid


Route::post('/login', 'App\Http\Controllers\Authcontroller@login');
Route::get('/log', 'App\Http\Controllers\Authcontroller@log')->name('log'); 
Route::get('/', 'App\Http\Controllers\Authcontroller@log')->name('log'); 


Route::middleware(['auth'])->group(function(){


Route::get('/apreslogin','App\Http\Controllers\Authcontroller@apreslogin');
Route::get('/logout','App\Http\Controllers\Authcontroller@logout');
Route::get('/passwordedit','App\Http\Controllers\Authcontroller@editpassword');
Route::patch('/passwordupdate','App\Http\Controllers\Authcontroller@updatepassword');
  Route::resource('users',Authcontroller::class);


});