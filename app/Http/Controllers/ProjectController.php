<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\User;
use App\Models\Departement;
use App\Models\UserProject;
use App\Models\Phase;
use App\Models\Vra;
use App\Mail\SendEmail;
use Session;
use Storage;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=User::latest()->get();

        if (Auth::user()->poste=="admin" || Auth::user()->poste=="Divisionnaire" ||  Auth::user()->poste=="vice president"){
            $projects=Project::latest()->get();
        }
        else {
            if(Auth::user()->poste=="relai"){
                $projects=Project::where('departement_id',Auth::user()->division)->latest()->get();;
            }
            else{
            $user_id=Auth::user()->id;
          $projects=Project::whereRelation('user','id',$user_id)->latest()->get();
            }

        }


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
        $dep=Departement::get()->where('stat','=',1);

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

        $proje->departement_id= $request->input('StructurePilote');
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


            return view('projets/show',  ['project'=>$project ,'users'=>$users,'chef'=>$result[0],'rep'=>$result[1],'equipe'=>$result[2]]);
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
        $dep=Departement::get()->where('stat','=',1);

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


        return view('projets/edit', ['project'=>$project ,'users'=>$users,'chef'=>$result[0],'rep'=>$result[1],'equipe'=>$eq,'ei'=>$ei,'dep'=>$dep]);
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
                'departement_id'=> $request->input('StructurePilote'),
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





