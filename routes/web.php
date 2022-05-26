<?php
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ConnaissanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PhaseController;
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
    Route::middleware(['controle_creation_projet'])->group(function(){
        Route::resource('/projet', ProjectController::class)->only(['create','store']);

    });
    Route::middleware(['controle_archivage'])->group(function(){
        Route::get('/archive/{id}', 'App\Http\Controllers\ProjectController@archive');

    });
    Route::middleware(['controle_supression'])->group(function(){
        Route::resource('/projet', ProjectController::class)->only(['destroy']);


    });
Route::middleware(['projet'])->group(function(){
    Route::resource('/projet', ProjectController::class)->only(['edit','update']);

});
Route::middleware(['projetlecture'])->group(function(){
    Route::resource('/projet', ProjectController::class)->only(['show']);

});



Route::get('/fichier/{id}','App\Http\Controllers\UploadController@edit');

Route::post('/fichier/{id}','App\Http\Controllers\UploadController@store');



Route::get('/download/{file_path}/{fileNames}','App\Http\Controllers\UploadController@download')->where('file_path', '(.*)')->where('fileNames', '(.*)');
Route::get('/delete/{file_path}/{fileNames}/{id}','App\Http\Controllers\UploadController@delete')->where('file_path', '(.*)')->where('fileNames', '(.*)');
Route::middleware(['controle_statistique'])->group(function(){
    Route::get('/stat', 'App\Http\Controllers\VraController@index');

    Route::get('/stat/{id}', 'App\Http\Controllers\VraController@show');
});


Route::view('/coo-E&P', 'coo-ep.coo-ep');

Route::view('/coo-E&P-R', 'coo-ep.coo-ep-rapport');



Route::get('/phase', 'App\Http\Controllers\PhaseController@view');
Route::middleware(['controle_historique_equipe'])->group(function(){
    Route::get('{id}/hequipe','App\Http\Controllers\ProjectController@hist')->where('phase', '(.*)');


});
Route::middleware(['controle_espace_equipe'])->group(function(){
    Route::get('/{id}/equipe','App\Http\Controllers\UploadController@team')->where('phase', '(.*)');

});

Route::post('{id}/equipe','App\Http\Controllers\UploadController@store')->where('phase', '(.*)');

Route::get('/{id}/publicationequipe','App\Http\Controllers\Publication_projetController@index');
Route::post('/{id}/publicationequipe','App\Http\Controllers\Publication_projetController@store');





//hello
// routes walid

Route::get('/apreslogin','App\Http\Controllers\Authcontroller@apreslogin');
Route::get('/logout','App\Http\Controllers\Authcontroller@logout');
Route::get('/passwordedit','App\Http\Controllers\Authcontroller@editpassword');
Route::patch('/passwordupdate','App\Http\Controllers\Authcontroller@updatepassword');
Route::get('/profil/edit/{id}','App\Http\Controllers\Authcontroller@editprofil');
Route::patch('/profil/update/{id}','App\Http\Controllers\Authcontroller@updateprofil');
Route::middleware(['controle_gestion_role'])->group(function(){
    Route::resource('roles',RoleController::class);
});

Route::put('/roles/{id}/ajouter_acces','App\Http\Controllers\RoleController@ajouter_acces');
Route::get('/supprimeracces/{id}/{accesid}','App\Http\Controllers\RoleController@supprimer_acces');
Route::resource('users',Authcontroller::class);
Route::middleware(['controle_gestion_utilisateur'])->group(function(){

    Route::resource('users',Authcontroller::class)->only(['edit','create','index','update','store']);
    Route::post('/importexcel','App\Http\Controllers\Authcontroller@importerfichierexcel');

 });
 Route::middleware(['controle_gestion_division'])->group(function(){
    Route::resource('Division',DivisionController::class);

 });
 Route::middleware(['controle_gestion_phase'])->group(function(){
    Route::resource('Phase',PhaseController::class);

});


Route::resource('connaissances',ConnaissanceController::class);
Route::resource('publications',PublicationController::class);
Route::get('/telecharger/connaissances/{dossier}/{fichier}','App\Http\Controllers\ConnaissanceController@telecharger');
Route::get('/telecharger/publications/{dossier}/{fichier}','App\Http\Controllers\PublicationController@telecharger');
Route::get('publications/profil/{id}','App\Http\Controllers\PublicationController@indexprofil');
Route::get('connaissances/profil/{id}','App\Http\Controllers\ConnaissanceController@indexprofil');
Route::get('projets/profil/{id}','App\Http\Controllers\ProjectController@indexprofil');
Route::get('/publications/supprimer/{id}','App\Http\Controllers\PublicationController@supprimer');
Route::get('/connaissances/supprimer/{id}','App\Http\Controllers\ConnaissanceController@supprimer');




});
