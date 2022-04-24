<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Publication;
use Illuminate\Support\Facades\Response;
use File;

class UploadController extends Controller
{


 public function edit($id,$phase)
    {
        $project=Project::find($id);

        return view('projets/affichagefichier',['project'=>$project,'phase'=>$phase]);
    }



    public function store(Request $request,$id)
    {




        if ($request->hasFile(key:'random') ) {request()->file(key:'random')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/random',name:request()->file(key:'random')->getClientOriginalName(),options:'');   }

        if ($request->hasFile(key:'note') ) {request()->file(key:'note')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/note',name:'note-p'.$id,options:'');   }

        if ($request->hasFile(key:'fiche') ) {request()->file(key:'fiche')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/fiche',name:'fiche-p'.$id,options:'');   }

        if ($request->hasFile(key:'misc') ) {request()->file(key:'misc')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/misc',name:'misc-p'.$id,options:'');   }


        if ($request->hasFile(key:'team') ) {





            request()->file(key:'team')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/fichier_equipe',name:request()->file(key:'team')->getClientOriginalName(),options:'');   }

        return back();
    }





    public function team($id)
    {
        $project=Project::find($id);

        return view('projets/equipe',['project'=>$project]);
    }











    public function download($file_path,$fileNames)
    {

        if (file_exists($file_path))
        {
           // Send Download

            return Response::download($file_path.'\\'.$fileNames,$fileNames, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }

    }

    public function delete($file_path,$fileNames)
    {

        if (file_exists($file_path))
        {
           // Send Download
          File::delete($file_path.'\\'.$fileNames,$fileNames);
          return back();

        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }

    }









}
