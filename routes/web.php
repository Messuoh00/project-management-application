<?php
use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Authcontroller;
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

Route::resource('/projet', ProjectController::class);



Route::get('/download/{id}/{filename}', function($id,$filename)
{
    // Check if file exists in app/storage/file folder
    $file_path =storage_path('app\fichier-projet\fichier-projet-'.$id.'\\'.$filename);
    if (file_exists($file_path))
    {
        $fileNames = [];
       
        $files = \File::allFiles($file_path);
    
        foreach($files as $file) {
            array_push($fileNames, pathinfo($file)['basename']  );
        }
    
      


        // Send Download
        return Response::download($file_path.'\\'.$fileNames[0],$fileNames[0] , [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})->where('filename', '[A-Za-z0-9\-\_\.]+')->where('id','[0-9]+');



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
  Route::resource('publications',PublicationController::class);
  Route::get('/telecharger/{dossier}/{fichier}','App\Http\Controllers\PublicationController@telecharger');


});