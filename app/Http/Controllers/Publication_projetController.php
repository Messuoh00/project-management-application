<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication_projet;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Publication;
use App\Models\User;
use File;


class Publication_projetController extends Controller
{

    public function index($id)
    {

        $pub=Publication_projet::get()->where('project_id','=',$id);

        $test=array();


        foreach ($pub as $p ) {
        $test[]=$p->publication_id;
        }


        $publications=Publication::orderBy('date_publication','DESC')->whereIn('id',$test)->get();



        return view('projets/equipepub',['publications'=>$publications]);
    }


    public function store(Request $request)
    {

        $this->validate($request,[

            'commentaire' => 'required',
        ]);


        $publication=Publication::create([

            'commentaire' => $request->input('commentaire'),
            'fichiers'=>'',
            'user_id'=>Auth::user()->id,


        ]);


        $publication1=Publication_projet::create([

            'publication_id' => $publication->id,
            'project_id'=>$request->input('id'),

        ]);




         if($request->hasFile('fichiers')){


         $publication->fichiers='publications/publication'.$publication->id;
         $publication->save();
         $routefichier=storage_path('app/'.$publication->fichiers);
         if (file_exists($routefichier)){
            File::deleteDirectory($routefichier);

         }
         foreach(($request->file('fichiers')) as $fichier){


             $nomfichier=time().'.'.$fichier->getClientOriginalName();

            $route=$fichier->storeAs('publications/publication'.$publication->id,$nomfichier);


         }}

        return back();
    }


    function telecharger(Request $request,$dossier,$fichier){

        $file = storage_path('app/publications/'.$dossier.'/'.$fichier);


        if (File::exists($file)){
            return response()->download(storage_path('app/publications/'.$dossier.'/'.$fichier));

        }
        else{
            exit('ce fichier existe pas!');
        }

    }



    function supprimer($id){
       $publication=Publication::find($id);
       $dossier=storage_path('app/'.$publication->fichiers);

       File::deleteDirectory($dossier);

       $publication->delete();
       return back();

    }
}
