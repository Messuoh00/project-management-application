<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Publication;
use App\Models\User;

class PublicationController extends Controller
{
    //
    function create(){

        return view('publication/formulairepublication');
    }
    function store(Request $request){
        $this->validate($request,[
            'titre' => 'required',
            'corps' => 'required',
        ]);
        
       
        $publication=Publication::create([
           'titre' => $request->input('titre'),
            'corps' => $request->input('corps'),
            'user_id'=>Auth::user()->id,
        ]); 
        
        
        
         foreach(($request->file('fichiers')) as $fichier){
             
            $route= Storage::disk('public')->put('avatars',$fichier);
            fichier::create([
                'publication_id'=>$publication->id,
                'route'=>$route,
            ]);

         }
         
        return redirect('publications/create');
    }
    function index(){
       $publications=Publication::orderBy('date_publication','DESC')->get();
       
       
       $slides=[];

       foreach($publications as $pub){
           $slides[]=1;
           
       }
       
        return view('publication/listepublications',['publications'=>$publications,'slides'=>$slides]);
    }

    function telecharger(Request $request,$dossier,$fichier){
        
        $file = Storage::disk('public')->get('/'.$dossier.'/'.$fichier);
  
        return response()->download(storage_path('app/public/'.$dossier.'/'.$fichier));



    }
    function indexprofil($id){
        $user=User::find($id);
        
        $publications=$user->publications->sortByDesc('date_publication');
        $slides=[];

        foreach($publications as $pub){
            $slides[]=1;
            
        }
        
         return view('publication/listepublications',['publications'=>$publications,'slides'=>$slides]);
        
      
    }
}
