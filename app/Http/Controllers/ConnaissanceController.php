<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Connaissance;
use App\Models\User;
use File;

class ConnaissanceController extends Controller
{
    function create(){

        return view('connaissance/formulaireconnaissance');
    }
    function store(Request $request){
        $this->validate($request,[
           
            'fichiers' => 'required',
        ]);
        
       
        $connaissance=Connaissance::create([
           
            'commentaire' => $request->input('commentaire'),
            'fichiers'=>'',
            'user_id'=>Auth::user()->id,
        ]); 
        
         if($request->hasFile('fichiers')){

         
         $connaissance->fichiers='connaissances/connaissance'.$connaissance->id;
         $connaissance->save();
         $routefichier=storage_path('app/public/'.$connaissance->fichiers);
         if (file_exists($routefichier)){
            File::deleteDirectory($routefichier);

         }
         foreach(($request->file('fichiers')) as $fichier){

             
             $nomfichier=time().'.'.$fichier->getClientOriginalName();
             
            $route=$fichier->storeAs('public/connaissances/connaissance'.$connaissance->id,$nomfichier);
            
            
         }} 
         
        return redirect('connaissances/create');
    }
    function index(){
        $connaissances=Connaissance::orderBy('date_publication','DESC')->get();
        
        
        $slides=[];
 
        foreach($connaissances as $con){
            $slides[]=1;
            
        }
        
         return view('connaissance/listeconnaissances',['connaissances'=>$connaissances,'slides'=>$slides]);
     }
     function telecharger(Request $request,$dossier,$fichier){
      
        $file = storage_path('app/public/connaissances/'.$dossier.'/'.$fichier);
        
       
        if (File::exists($file)){
            return response()->download(storage_path('app/public/connaissances/'.$dossier.'/'.$fichier));

        }
        else{
            exit('ce fichier existe pas!');
        }
    }
    function indexprofil($id){
        $user=User::find($id);
        
        $connaissances=$user->connaissances->sortByDesc('date_publication');
        $slides=[];

        foreach($connaissances as $pub){
            $slides[]=1;
            
        }
        
         return view('connaissance/listeconnaissances',['connaissances'=>$connaissances,'slides'=>$slides]);
        
      
    }
    function supprimer($id){
        $connaissance=Connaissance::find($id);
        $dossier=storage_path('app/public/'.$connaissance->fichiers);
        
        File::deleteDirectory($dossier);
        
        $connaissance->delete();
        return redirect('connaissances');
 
     }

}
