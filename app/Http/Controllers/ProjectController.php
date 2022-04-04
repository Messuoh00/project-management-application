<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use App\Mail\SendEmail;
use Session;

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
        $proje->extras='refus';
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
       
       
       
        
      return redirect('projet/'.$proje->id);
    
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
            $chef="";
           $rep="";
    


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
            
        
        return view('projets/show',  ['project'=>$project ,'users'=>$users,'chef'=>$chef,'rep'=>$rep,'equipe'=>$equipe]);
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
           
           $test=(
          

            (file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$id.'\note')  )and($project->phase==1.2) and(strcmp($project->extras,"accord")==0) and file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$id.'\fiche') ) )
            or
            (file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$id.'\misc') )and($project->phase==2.2))
            or
            ($project->phase==2.1)
            or
            ($project->phase==1.1)
            or
            ($project->phase==3.1)

           );
          

        if ($test) {

            
       
           $project->phase=$request->input('updatephase');
           $project->save();
           
           $equipe=DB::select("
            
           select email from users where  id IN 
           
           (
               select user_id from project_user
               where project_id='".$id."'
           )
           
           ");
           
           $c=User::find($project->chef_projet);
           $r=User::find($project->representant_EP);

           Mail::to($c->email)->send(new SendEmail());
           Mail::to($r->email)->send(new SendEmail());

           foreach ( $equipe as  $membre) {
            Mail::to($membre->email)->send(new SendEmail());
           }
        
        }else{ return redirect('fichier/'.$project->id.'/'.$request->input("currentphase").'?var=edit')->with('alert', 'PASSAGE IMPOSSIBLE IL MANQUE DES FICHIER'); }

      
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
                'extras'=> $request->input('extras'),
                
                'description'=> $request->input('Description'),
                
                'visibilite'=> $request->input('Visibilite'),
                
                'reactivite'=> $request->input('Reactivite'),
                
                'avancement'=> $request->input('Avancement'),

               
        
            ]
            );

            DB::table('project_user')->where('project_id', $id)->delete();

            
      $xs= $request->input('equipeid');
      $array = explode(',',$xs[0]);
       
        foreach ($array as $x) { 
            $equipe=new UserProject();
            $equipe->project_id= $id;
            $equipe->user_id=$x;
            $equipe->save();
        }

    
        }
       


            return redirect('projet/'.$id);
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



    
    public function stat()
    {
        $projects=Project::latest()->get();

        $names=array();
        $vis=array();
        $reac=array();
        $avan=array();
  
        $phasenom='';
        $phase= $phase11 = Project::latest()->where('phase',1.1)->get();
        $count11 = count($phase11);

      
        $phase12 = Project::latest()->where('phase',1.2)->get();
        $count12 = count($phase12);
        
        $phase21 = Project::latest()->where('phase',2.1)->get();
        $count21 = count($phase21);
        
        $phase22 = Project::latest()->where('phase',2.2)->get();
        $count22 = count($phase22);

      


        $switch=request()->input('var'); 
        switch ($switch) {
            case '1.1':
                $phase= $phase11 ;$phasenom='Idee R/D';
                break;
            case '1.2':
                $phase= $phase12 ;$phasenom='Maturation ';
                break;
                
            case '2.1':
                $phase= $phase21; $phasenom='RECHERCHE';
                break;

            case '2.2':
                $phase= $phase22; $phasenom='Test Pilote';
                break;
            
            
            default:
              
                break;
        }
      

        foreach ($phase as $val) {
            $names[]='projet n:'.$val->id;
            $vis[]=$val->visibilite;
            $reac[]=$val->reactivite;
            $avan[]=$val->avancement;
        }
        
      
        
        return view('projets.stats',compact('count11','count12','count21','count22','names','vis','reac','avan','phasenom'));
    }

    



    
}





