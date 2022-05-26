<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\User;
use App\Models\Division;
use App\Models\UserProject;
use App\Models\Phase;
use App\Models\Vra;
use App\Mail\SendEmail;
use Session;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\acces;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* code walid:afficher la liste de projet selon l'acces */
        $user_id=Auth::user()->id;
        if(auth::user()->role==null){
            $projects=[];
            return view('projets/index', ['projects'=>$projects]);

        }
        $role_id=auth::user()->role->id;
        $tous_les_privileges=acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();
        $acces_lecture_tous_les_projets=acces::where('nom_acces','lecture de tous les projets')->whereRelation('roles','roles.id',$role_id)->get()->first();





        if ($tous_les_privileges!=null||$acces_lecture_tous_les_projets!=null){
            $projects=Project::latest()->get();
        }
        else {
            $acces_lecture_par_division=acces::where('nom_acces','lecture de projets de la meme division')->whereRelation('roles','roles.id',$role_id)->get()->first();

            if($acces_lecture_par_division!=null){
                $projects=Project::where('division_id',Auth::user()->division->id)->latest()->get();;
            }
            else{
           $acces_lecture=acces::where('nom_acces','lecture de projet affecté')->whereRelation('roles','roles.id',$role_id)->get()->first();
           if($acces_lecture!=null){

           

            
          $projects=Project::whereRelation('user','id',$user_id)->latest()->get();}
          else{
              $projects=[];
          }
            }

        }


        return view('projets/index', ['projects'=>$projects]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $users=User::latest()->get();
        $dep=Division::get()->where('stat','=',1);

        return view('projets/create',['users'=>$users,'dep'=>$dep]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'NomProjet'=>'required',
            'Abreviation'=>'required',
            'Thematique'=>'required',
            'DateDebut'=>'required',
            'Description'=>'required',
            'DateFin'=>'required|after:DateDebut',
            'inlineRadioOptions'=>'required',
        ]);


        $phase= DB::table('phases')->where('position','=',0)->first();

        $proje=new Project();
        $proje->nom_projet= $request->input('NomProjet');
        $proje->abreviation= $request->input('Abreviation');
        $proje->thematique= $request->input('Thematique');

        $proje->division_id= $request->input('StructurePilote');
        $proje->phase_id=$phase->id;

        $proje->region_test="";
        $proje->region_implementation="";
        $proje->region_exploitation="";
        $proje->budget= $request->input('budget');
        $proje->date_deb= $request->input('DateDebut');
        $proje->date_fin= $request->input('DateFin');

        $proje->etude_echo= $request->input('inlineRadioOptions');
        $proje->description= $request->input('Description');


        $proje->save();

        DB::table('projects')->where('id', $proje->id)->update(['files' =>'/fichier-projet/fichier-projet-'.$proje->id]);

        $proje->createvra($request);

        $proje->createquipe($request);



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

            $users=User::latest()->get();

            $result=$project->getequipe();

            /* code walid:preparation des accès pour les traiter en front end*/
            $user_id=Auth::user()->id;
            if(auth::user()->role==null){
                return abort(403);
            }
            $role_id=auth::user()->role->id;
            $acces_espace_equipe=acces::where('nom_acces','gérer les fichiers de espace equipe des projets accessibles en lecture')->whereRelation('roles','roles.id',$role_id)->get()->first();
            $acces_historique=acces::where('nom_acces','consultation historique equipe des projets accessibles en lecture')->whereRelation('roles','roles.id',$role_id)->get()->first();
            $acces_statistique=acces::where('nom_acces','consultation des statistiques')->whereRelation('roles','roles.id',$role_id)->get()->first();

            $tous_les_privileges=acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();







            return view('projets/show',  ['project'=>$project ,'users'=>$users,'chef'=>$result[0],'rep'=>$result[1],'equipe'=>$result[2],'acces_espace_equipe'=> $acces_espace_equipe,'acces_historique_equipe'=>$acces_historique,'tous_les_privileges'=>$tous_les_privileges,'acces_statistique'=>$acces_statistique]);
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
        $dep=Division::get()->where('stat','=',1);

        if ($project==null) {
            return redirect('projet');

        }else{


            $eq=array();
            $ei=array();

            $users=User::latest()->get();

            $result=$project->getequipe();


            if ($result[2]!=null) {

            foreach ($result[2] as $x) {

                $eq[]=$x->nom.' '.$x->prenom;
                $ei[]=$x->id;

            }

            }
            /* code walid:preparation des accès pour les traiter en front end!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
            $user_id=Auth::user()->id;
            if(auth::user()->role==null){
                return abort(403);
            }
            $role_id=auth::user()->role->id;
            
            $tous_les_privileges=acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();
            
            $acces_ecriture_tous_les_projets=acces::where('nom_acces','ecriture de tous les projets')->whereRelation('roles','roles.id',$role_id)->get()->first();
            $acces_ecriture_par_division=acces::where('nom_acces','ecriture de projets de la meme division')->whereRelation('roles','roles.id',$role_id)->get()->first();
           
            $acces_ecriture=acces::where('nom_acces','ecriture de projet affecté')->whereRelation('roles','roles.id',$role_id)->get()->first();
            $acces_ecriture_chef_rep=acces::where('nom_acces','ecriture de projet affecté que en etant chef/représentant du projet')->whereRelation('roles','roles.id',$role_id)->get()->first();
            
            




        return view('projets/edit', ['project'=>$project ,'users'=>$users,'chef'=>$result[0],'rep'=>$result[1],'equipe'=>$eq,'ei'=>$ei,'dep'=>$dep,'tous_les_privileges'=>$tous_les_privileges,'acces_ecriture_tous_les_projets'=>$acces_ecriture_tous_les_projets,'acces_ecriture_par_division'=>$acces_ecriture_par_division,'acces_ecriture'=>$acces_ecriture,'acces_ecriture_chef_rep'=>$acces_ecriture_chef_rep,]);
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
        $project= Project::find($id);



        if ($request->has('currentphase')) {

             $this->passage($project,$request);

        }else{

            $request->validate([
                'NomProjet'=>'required',
                'Abreviation'=>'required',
                'Thematique'=>'required',
                'DateDebut'=>'required',
                'Description'=>'required',
                'DateFin'=>'after:DateDebut',

            ]);

        Project::where('id',$id)->update(
            [
                'nom_projet' =>  $request->input('NomProjet'),
                'abreviation'=> $request->input('Abreviation'),
                'thematique'=> $request->input('Thematique'),
                'division_id'=> $request->input('StructurePilote'),
                'region_test'=> $request->input('RegionTest'),
                'region_implementation'=> $request->input('RegionImp'),
                'region_exploitation'=> $request->input('RegionExp'),
                'budget'=> $request->input('budget'),
                'date_deb'=> $request->input('DateDebut'),
                'date_fin'=> $request->input('DateFin'),
                'etude_echo'=> $request->input('inlineRadioOptions'),
                'description'=> $request->input('Description'),
            ]
            );

            $project->updateequipe($request);

            $project->createvra($request);

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




    public function passage($project,$request)
    {


           $phase=DB::table('phases')->get()->where('position','=',$request->input('currentphase')+1)->first();

           if (empty($phase)) {

              return false;
           }else{

            $va=new Vra();
            $va->project_id=$project->id;
            $va->phase_id=$phase->id;
            $va->save();


           $project->phase_id=$phase->id;
           $project->save();


           if ($request->input('sendmail')=='1') {

            $equipe=DB::select("

            select email from users where  id IN

            (
                select user_id from project_user
                where statut=1 and project_id='".$project->id."'
            )

            ");

           foreach ( $equipe as  $membre) {
            if ($membre!=null) {
            Mail::to($membre->email)->send(new SendEmail());
                }
            }

            }

            return true;
        }


    }


    public function archive($id){
        $project=Project::find($id);
        $project->phase_id=1;
        $project->save();
        return redirect('projet/'.$id);
    }


    public function hist($id)
    {
        $chef=DB::select("

        select users.nom,users.prenom,users.id,project_user.updated_at FROM users INNER JOIN project_user
            ON users.id = project_user.user_id
                where statut=0 and post=1 and project_id='".$id."'



        ");

        $rep=DB::select("

        select users.nom,users.prenom,users.id,project_user.updated_at FROM users INNER JOIN project_user
        ON users.id = project_user.user_id
            where statut=0 and post=2 and project_id='".$id."'

        ");

        $membre=DB::select("

        select users.nom,users.prenom,users.id,project_user.updated_at FROM users INNER JOIN project_user
        ON users.id = project_user.user_id
            where statut=0 and post=3 and project_id='".$id."'

        ");

        return view('projets/historique_eq',['membres'=> $membre,'chefs'=>$rep,'reps'=> $chef,'id'=>$id]);
    }




}





