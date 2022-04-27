<?php
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DepartementController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
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




Route::post('/login', 'App\Http\Controllers\Authcontroller@login');
Route::get('/log', 'App\Http\Controllers\Authcontroller@log')->name('log');
Route::get('/', 'App\Http\Controllers\Authcontroller@log')->name('log');


Route::middleware(['auth'])->group(function(){
    

    Route::resource('/projet', ProjectController::class);

//route houssem
Route::middleware(['projet'])->group(function(){
    Route::resource('/projet', ProjectController::class)->only(['edit','destroy','update']);
});
Route::middleware(['projetlecture'])->group(function(){
    Route::resource('/projet', ProjectController::class)->only(['show']);
   
});



Route::get('/fichier/{id}/{phase}','App\Http\Controllers\UploadController@edit')->where('phase', '(.*)');

Route::post('/fichier/{id}/{phase}','App\Http\Controllers\UploadController@store')->where('phase', '(.*)');



Route::get('/download/{file_path}/{fileNames}','App\Http\Controllers\UploadController@download')->where('file_path', '(.*)')->where('fileNames', '(.*)');
Route::get('/delete/{file_path}/{fileNames}/{id}/{phsae}','App\Http\Controllers\UploadController@delete')->where('file_path', '(.*)')->where('fileNames', '(.*)')->where('phase', '(.*)');

Route::get('/stat', 'App\Http\Controllers\ProjectController@stat');

Route::view('/coo-E&P', 'coo-ep.coo-ep');

Route::view('/coo-E&P-R', 'coo-ep.coo-ep-rapport');





Route::get('/{id}/equipe','App\Http\Controllers\UploadController@team')->where('phase', '(.*)');

Route::post('{id}/equipe','App\Http\Controllers\UploadController@store')->where('phase', '(.*)');


Route::get('{id}/hequipe','App\Http\Controllers\ProjectController@hist')->where('phase', '(.*)');





//hello
// routes walid

Route::get('/apreslogin','App\Http\Controllers\Authcontroller@apreslogin');
Route::get('/logout','App\Http\Controllers\Authcontroller@logout');
Route::get('/passwordedit','App\Http\Controllers\Authcontroller@editpassword');
Route::patch('/passwordupdate','App\Http\Controllers\Authcontroller@updatepassword');
Route::resource('users',Authcontroller::class);
Route::middleware(['admin'])->group(function(){
    Route::resource('/projet', ProjectController::class)->only(['create','store']);
    Route::resource('users',Authcontroller::class)->only(['edit','create','index','update','store']);    
    Route::resource('Departement',DepartementController::class);
 });

Route::resource('publications',PublicationController::class);
Route::get('/telecharger/publications/{dossier}/{fichier}','App\Http\Controllers\PublicationController@telecharger');
Route::get('publications/profil/{id}','App\Http\Controllers\PublicationController@indexprofil');
Route::get('/publications/supprimer/{id}','App\Http\Controllers\PublicationController@supprimer');



});
