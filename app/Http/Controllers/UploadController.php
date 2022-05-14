<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use App\Models\fichier;
use App\Models\Phase;
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


        $phase=Phase::orderBy('position')->get()->whereNotNull('position');

        foreach ($phase as $p) {

            if ($request->hasFile(key:$p->id) ) {request()->file(key:$p->id)->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/'.$p->name,name:'fichier '.$p->name.' du projet '.$id.'.'.request()->file(key:$p->id)->getClientOriginalExtension(),options:'');   }

        }

        if ($request->hasFile(key:'random') ) {request()->file(key:'random')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/random',name:request()->file(key:'random')->getClientOriginalName(),options:'');   }


        if ($request->hasFile(key:'team') ) {request()->file(key:'team')->storeAs(path:'fichier-projet/fichier-projet-'.$id.'/fichier_equipe',name:request()->file(key:'team')->getClientOriginalName(),options:'');   }

        if ($request->hasFile(key:'rapp') ) {request()->file(key:'rapp')->storeAs(path:'rapport',name:request()->file(key:'rapp')->getClientOriginalName(),options:'');   }


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
