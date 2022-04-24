<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Publication;
use App\Models\User;
use File;


class PublicationController extends Controller
{
    //
    function create(){

        return view('publication/formulairepublication');
    }
    function store(Request $request){
        $this->validate($request,[
           
            'corps' => 'required',
        ]);
        
       
        $publication=Publication::create([
           
            'corps' => $request->input('corps'),
            'fichiers'=>'',
            'user_id'=>Auth::user()->id,
        ]); 
        
         if($request->hasFile('fichiers')){

         
         $publication->fichiers='publications/publication'.$publication->id;
         $publication->save();
         foreach(($request->file('fichiers')) as $fichier){

             
             $nomfichier=time().'.'.$fichier->getClientOriginalName();
             
            $route=$fichier->storeAs('public/publications/publication'.$publication->id,$nomfichier);
            
            
         }} 
         
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
      
        $file = storage_path('app/public/publications/'.$dossier.'/'.$fichier);
        
       
        if (File::exists($file)){
            return response()->download(storage_path('app/public/publications/'.$dossier.'/'.$fichier));

        }
        else{
            exit('ce fichier existe pas!');
        }
  
        



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
    function supprimer($id){
       $publication=Publication::find($id);
       $dossier=storage_path('app/public/'.$publication->fichiers);
       
       File::deleteDirectory($dossier);
       
       $publication->delete();
       return redirect('publications');

    }
}
