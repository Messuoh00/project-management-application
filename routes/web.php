<?php
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UploadController;
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



//route houssem
//hello
//hello




// Route::get('/download/{file_path}/{fileNames}', function($file_path,$fileNames)
// {
//     // Check if file exists in app/storage/file folder
   
//     if (file_exists($file_path))
//     {
//        // Send Download
//         return Response::download($file_path.'\\'.$fileNames,$fileNames, [
//             'Content-Length: '. filesize($file_path)
//         ]);
//     }
//     else
//     {
//         // Error
//         exit('Requested file does not exist on our server!');
//     }
// })->where('file_path', '[A-Za-z0-9\-\_\.]+')->where('fileNames','[A-Za-z0-9\-\_\.]+')->where('file_path', '(.*)')->where('fileNames', '(.*)');








// routes walid


Route::post('/login', 'App\Http\Controllers\Authcontroller@login');
Route::get('/log', 'App\Http\Controllers\Authcontroller@log')->name('log'); 
Route::get('/', 'App\Http\Controllers\Authcontroller@log')->name('log'); 


Route::middleware(['auth'])->group(function(){


    
Route::resource('/projet', ProjectController::class);


Route::get('/fichier/{id}/{phase}','App\Http\Controllers\UploadController@edit');

Route::post('/fichier/{id}','App\Http\Controllers\UploadController@store');

Route::get('/download/{file_path}/{fileNames}','App\Http\Controllers\UploadController@download')->where('file_path', '(.*)')->where('fileNames', '(.*)');


Route::get('/apreslogin','App\Http\Controllers\Authcontroller@apreslogin');
Route::get('/logout','App\Http\Controllers\Authcontroller@logout');
Route::get('/passwordedit','App\Http\Controllers\Authcontroller@editpassword');
Route::patch('/passwordupdate','App\Http\Controllers\Authcontroller@updatepassword');

Route::resource('users',Authcontroller::class);
Route::resource('publications',PublicationController::class);
Route::get('/telecharger/{dossier}/{fichier}','App\Http\Controllers\PublicationController@telecharger');


Route::view('/coo-E&P', 'coo-ep.coo-ep');
Route::view('/coo-E&P-R', 'coo-ep.coo-ep-rapport');

});