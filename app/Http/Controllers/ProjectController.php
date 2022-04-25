<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\User;
use App\Models\Departement;
use App\Models\UserProject;
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
                $projects=Project::where('structure_pilote',Auth::user()->division)->latest()->get();;
            }
            else{
            $user_id=Auth::user()->id;
          $projects=Project::whereRelation('user','id',$user_id)->orWhere('chef_projet',$user_id)->orWhere('representant_EP',$user_id)->latest()->get();
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
        $dep=Departement::get();

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



        $proje=new Project();
        $proje->nom_projet= $request->input('NomProjet');
        $proje->abreviation= $request->input('Abreviation');
        $proje->thematique= $request->input('Thematique');
        $proje->structure_pilote= $request->input('StructurePilote');
        $proje->phase='0';
        $proje->extras='refus';
        $proje->region_test= $request->input('RegionTest');
        $proje->region_implementation= $request->input('RegionImp');
        $proje->region_exploitation= $request->input('RegionExp');
        $proje->budget= $request->input('budget');
        $proje->date_deb= $request->input('DateDebut');
        $proje->date_fin= $request->input('DateFin');

        $proje->etude_echo= $request->input('inlineRadioOptions');
        $proje->description= $request->input('Description');


        $proje->save();

        DB::table('projects')->where('id', $proje->id)->update(['files' =>'/fichier-projet/fichier-projet-'.$proje->id]);




        $equipe=new UserProject();
        $equipe->project_id= $proje->id;
        $equipe->user_id=$request->input('Chefid');
        $equipe->post=1;
        $equipe->statut=1;
        $equipe->save();

        $equipe=new UserProject();
        $equipe->project_id= $proje->id;
        $equipe->user_id=$request->input('RepresentantE&Pid');
        $equipe->post=2;
        $equipe->statut=1;
        $equipe->save();

        $xs= $request->input('equipeid');
        $array = explode(',',$xs[0]);

        foreach ($array as $x) {
            if(!empty($x)){
            $equipe=new UserProject();
            $equipe->project_id= $proje->id;
            $equipe->user_id=$x;
            $equipe->post=3;
            $equipe->statut=1;
            $equipe->save();
        }
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



            $rep=array();
            $chef=array();
            $users=User::latest()->get();

            $chef0=DB::select("

            select nom,prenom,id from users where id IN

            (
                select user_id from project_user
                where  statut=1 and post=1 and project_id='".$id."'
            )

            ");

            foreach ($chef0 as $temp) {

                $chef=$temp;

            }


            $rep0=DB::select("

            select nom,prenom,id from users where id IN

            (
                select user_id from project_user
                where statut=1 and post=2 and  project_id='".$id."'
            )

            ");

            foreach ($rep0 as $temp) {

                $rep=$temp;

            }

            $equipe=DB::select("

            select nom,prenom,id from users where id IN

            (
                select user_id from project_user
                where statut=1 and post=3 and  project_id='".$id."'
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
        $dep=Departement::get();

        if ($project==null) {
            return redirect('projet');

        }else{

            $chef="";
            $rep="";
            $eq=array();
            $ei=array();


            $users=User::latest()->get();


            $chef0=DB::select("

            select nom,prenom,id from users where id IN

            (
                select user_id from project_user
                where  statut=1 and post=1 and project_id='".$id."'
            )

            ");



            foreach ($chef0 as $temp) {

                $chef=$temp;

            }


            $rep0=DB::select("

            select nom,prenom,id from users where id IN

            (
                select user_id from project_user
                where statut=1 and post=2 and  project_id='".$id."'
            )

            ");


            foreach ($rep0 as $temp) {

                $rep=$temp;

            }



            $equipe=DB::select("

            select nom,prenom,id from users where  id IN

            (
                select user_id from project_user
                where statut=1 and post=3  and project_id='".$id."'
            )

            ");

            if ($equipe!=null) {




            foreach ($equipe as $x) {

                $eq[]=$x->nom.' '.$x->prenom;
                $ei[]=$x->id;

            }

            }

        return view('projets/edit', ['project'=>$project ,'users'=>$users,'chef'=>$chef,'rep'=>$rep,'equipe'=>$eq,'ei'=>$ei,'dep'=>$dep]);
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

        if ($request->has('updatephase')) {


          if( !$this->passage($project,$request) ){
             return redirect('fichier/'.$project->id.'/'.$request->input("currentphase").'?var=edit')->with('alert', 'PASSAGE IMPOSSIBLE IL MANQUE DES FICHIER');

          }


        }else{

            $request->validate([
                'NomProjet'=>'required',
                'Abreviation'=>'required',
                'Thematique'=>'required',
                'DateDebut'=>'required',
                'Description'=>'required',
                'DateFin'=>'after:DateDebut',

            ]);


            if ($project->phase==4) { $request->validate([ "RegionTest" => "required",]);}
            if ($project->phase==5) { $request->validate([ "RegionImp" => "required",]);}
            if ($project->phase==6) { $request->validate([ "RegionExp" => "required",]);}


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


                'etude_echo'=> $request->input('inlineRadioOptions'),
                'extras'=> $request->input('extras'),

                'description'=> $request->input('Description'),

                'visibilite'=> $request->input('Visibilite'),

                'reactivite'=> $request->input('Reactivite'),

                'avancement'=> $request->input('Avancement'),



            ]
            );

            // 'chef_projet'=> $request->input('Chefid'),
            // 'representant_EP'=> $request->input('RepresentantE&Pid'),

            DB::table('project_user')->where('project_id', $id)->update(['statut' =>0]);



            $xs= $request->input('equipeid');
            $array = explode(',',$xs[0]);



            foreach ($array as $x) {


                if(!empty($x)){

                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$x);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);
                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $id;
                    $equipe->user_id=$x;
                    $equipe->post=3;
                    $equipe->statut=1;
                    $equipe->save();
                }


                }
            }






                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$request->input('Chefid'));

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);
                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $id;
                    $equipe->user_id=$x;
                    $equipe->post=1;
                    $equipe->statut=1;
                    $equipe->save();
                }

                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$request->input('RepresentantE&Pid'));

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);
                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $id;
                    $equipe->user_id=$x;
                    $equipe->post=2;
                    $equipe->statut=1;
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








    public function stat(Request $request)
    {


        $names=array();
        $vis=array();
        $reac=array();
        $avan=array();

        if (request()->input('x')=='') {
            $phase= $phase1 = Project::latest()->where('phase',1)->get();
            $count1 = count($phase1);


            $phase2 = Project::latest()->where('phase',2)->get();
            $count2 = count($phase2);

            $phase3 = Project::latest()->where('phase',3)->get();
            $count3 = count($phase3);

            $phase4 = Project::latest()->where('phase',4)->get();
            $count4 = count($phase4);

            $phase5 = Project::latest()->where('phase',5)->get();
            $count5 = count($phase5);


        $switch=request()->input('var');
        switch ($switch) {
            case '1':
                $phase= $phase1 ;
                break;
            case '2':
                $phase= $phase2 ;
                break;

            case '3':
                $phase= $phase3;
                break;

            case '4':
                $phase= $phase4;
                break;

            case '5':
                $phase= $phase5;
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


        }else{


            $switch=request()->input('var');
            $date=request()->input('x');
            $recoveredData=false;

        switch ($switch) {
            case '1':
                if (file_exists(Storage::path('archiveVRA/'.$date.' Idee RD.txt') ))  { $recoveredData =  file_get_contents(Storage::path('archiveVRA/'.$date.' Idee RD.txt')); }
                break;
            case '2':
                if (file_exists( Storage::path('archiveVRA/'.$date.' Maturation.txt')))  {  $recoveredData = file_get_contents(Storage::path('archiveVRA/'.$date.' Maturation.txt'));}
                break;

            case '3':
                if (file_exists( Storage::path('archiveVRA/'.$date.' Recherche.txt')))  {   $recoveredData = file_get_contents(Storage::path('archiveVRA/'.$date.' Recherche.txt'));}

                break;

            case '4':
                if (file_exists( Storage::path('archiveVRA/'.$date.' Test.txt')))  { $recoveredData = file_get_contents(Storage::path('archiveVRA/'.$date.' Test.txt'));}

                break;

            case '5':
                if (file_exists(Storage::path('archiveVRA/'.$date.' Implementation.txt') ))  { $recoveredData = file_get_contents(Storage::path('archiveVRA/'.$date.' Implementation.txt'));}

                break;


            default:

                break;
        }


        if (!$recoveredData) {

            return redirect()->back();
        }


            $recoveredArray = unserialize($recoveredData);

            $i=1;
            $x='';
            while (isset($recoveredArray[$i])) {

                $names[]=$recoveredArray[$i];
                $vis[]=$recoveredArray[$i+1];
                $reac[]=$recoveredArray[$i+2];
                $avan[]=$recoveredArray[$i+3];
                $i=$i+4;

            }

            $count5=$count4=$count3=$count2=$count1=$i-1;
        }









        return view('projets.stats',compact('count1','count2','count3','count4','count5','names','vis','reac','avan'));
    }















    public function passage($project,$request)
    {

        $test=(


            (file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\note')  )and($project->phase==2) and file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\fiche') ) )
            or
            (file_exists(  storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\misc') )and($project->phase==4))
            or
            ($project->phase==3)
            or
            ($project->phase==1)
            or
            ($project->phase==5)
            or
            ($project->phase==0)

           );


        if ($test) {


            if ($project->phase==0) { if ($project->extras!='accord') {return back()->withErrors('accord non donne');} }

            if ($project->phase==2) { if ($project->extras!='accord') {return back()->withErrors('accord non donne');} }



           $project->phase=$request->input('updatephase');
           $project->extras='refus';
           $project->save();

           $equipe=DB::select("

           select email from users where  id IN

           (
               select user_id from project_user
               where statut=1 and project_id='".$project->id."'
           )

           ");
           if ($project->phase!=0) {
               # code...


           foreach ( $equipe as  $membre) {
            if ($membre!=null) {
            Mail::to($membre->email)->send(new SendEmail());
                }
            }

            }

            return true;
        }
        return false;
    }




    public function hist($id)
    {

        $chef=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where statut=0 and post=1 and project_id='".$id."'

        )

        ");

        $rep=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where statut=0 and post=2 and project_id='".$id."'

        )

        ");

        $membre=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where statut=0 and post=3 and project_id='".$id."'

        )

        ");

        return view('projets/historique_eq',['membres'=>$membre,'chefs'=>$chef,'reps'=>$rep,'id'=>$id]);
    }




}





