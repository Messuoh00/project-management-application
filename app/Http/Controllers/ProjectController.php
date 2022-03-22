<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $projects=Project::latest()->get();
        $user=User::latest()->get();
        
        

        return view('projets/index', ['projects'=>$projects,'user'=>$user]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $users=User::latest()->get();
       
        return view('projets/create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $x= DB::table('projects')->latest('created_at')->first();
        
        $id=$x->id;
        $id++;

        $proje=new Project();
        $proje->nom_projet= $request->input('NomProjet');
        $proje->abreviation= $request->input('Abreviation');
        $proje->thematique= $request->input('Thematique');
        $proje->structure_pilote= $request->input('StructurePilote');
        $proje->phase='1.1';

        $proje->region_test= $request->input('RegionTest');
        $proje->region_implementation= $request->input('RegionImp');
        $proje->region_exploitation= $request->input('RegionExp');
        $proje->budget= $request->input('budget');
        $proje->date_deb= $request->input('DateDebut');
        $proje->date_fin= $request->input('DateFin');
        $proje->chef_projet= $request->input('Chefid');
        $proje->representant_EP= $request->input('RepresentantE&Pid');
 
        $proje->etude_echo= $request->input('inlineRadioOptions');

        $proje->description= $request->input('Description');
        

        $proje->files='/fichier-projet/fichier-projet-'.$id;
       
       
        $proje->save();
       

        
      $xs= $request->input('equipeid');
      $array = explode(',',$xs[0]);

       

        foreach ($array as $x) { 
            $equipe=new UserProject();
            $equipe->project_id= $proje->id;
            $equipe->user_id=$x;
            $equipe->save();
        }
       
       
       
        
      return redirect('projet');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project=Project::find($id);

       
        
        if ($project==null) {
            return redirect('projet');
            
        }else{
        
        return view('projets/show', ['project'=>$project]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::find($id);
       

        if ($project==null) {
            return redirect('projet');
            
        }else{

            $chef="";
            $rep="";
            $eq=array();
            $ei=array();


            $users=User::latest()->get();
            $chef0= DB::table('users')->find($project->chef_projet);
            if ($chef0!=null) {
                $chef=$chef0->nom.' '.$chef0->prenom;
            }

            $rep0= DB::table('users')->find($project->representant_EP);
            
            if ($rep0!=null) {
                $rep=$rep0->nom.' '.$rep0->prenom;
            }


            $equipe=DB::select("
            
            select nom,prenom,id from users where  id IN 
            
            (
                select user_id from project_user
                where project_id='".$id."'
            )
            
            ");
            
            if ($equipe!=null) {
              
            

            
            foreach ($equipe as $x) {

                $eq[]=$x->nom.' '.$x->prenom;
                $ei[]=$x->id;
              
            }
        
            }
        
        return view('projets/edit', ['project'=>$project ,'users'=>$users,'chef'=>$chef,'rep'=>$rep,'equipe'=>$eq,'ei'=>$ei]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('updatephase')) {
           
           $project= Project::find($id);

           $project->phase=$request->input('updatephase');
           $project->save();
            return redirect('projet');
      
        }else{
        Project::where('id',$id)->update(
            [
                'nom_projet' =>  $request->input('NomProjet'),
                'abreviation'=> $request->input('Abreviation'),
                'thematique'=> $request->input('Thematique'),
                'structure_pilote'=> $request->input('StructurePilote'),
               
        
                'region_test'=> $request->input('RegionTest'),
                'region_implementation'=> $request->input('RegionImp'),
                'region_exploitation'=> $request->input('RegionExp'),
                'budget'=> $request->input('budget'),
                'date_deb'=> $request->input('DateDebut'),
                'date_fin'=> $request->input('DateFin'),
                'chef_projet'=> $request->input('Chefid'),
                'representant_EP'=> $request->input('RepresentantE&Pid'),
         
                'etude_echo'=> $request->input('inlineRadioOptions'),
        
                
                'description'=> $request->input('Description'),
                
                'visibilite'=> $request->input('Visibilite'),
                
                'reactivite'=> $request->input('Reactivite'),
                
                'avancement'=> $request->input('Avancement'),

               
        
            ]
            );

            DB::table('project_user')->where('project_id', $id)->delete();

            
               
            if ($request->hasFile(key:'note') ) {request()->file(key:'note')->storeAs(path:'fichier-projet/fichier-projet-'.$id,name:'note-p'.$id.'.pdf',options:'');   }

            if ($request->hasFile(key:'fiche') ) {request()->file(key:'fiche')->storeAs(path:'fichier-projet/fichier-projet-'.$id,name:'fiche-p'.$id.'.pdf',options:'');   }


      $xs= $request->input('equipeid');
      $array = explode(',',$xs[0]);
       
        foreach ($array as $x) { 
            $equipe=new UserProject();
            $equipe->project_id= $id;
            $equipe->user_id=$x;
            $equipe->save();
        }

    
        }
       


            return redirect('projet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::find($id);
       
        $project->delete();

        return redirect('projet');
    }



    






}





