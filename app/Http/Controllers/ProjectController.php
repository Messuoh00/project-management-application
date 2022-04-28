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




        if ($request->input('Chefid')!=null) {


        $equipe=new UserProject();
        $equipe->project_id= $proje->id;
        $equipe->user_id=$request->input('Chefid');
        $equipe->post=1;
        $equipe->statut=1;
        $equipe->save();
        }

        if ($request->input('RepresentantE&Pid')!=null) {

        $equipe=new UserProject();
        $equipe->project_id= $proje->id;
        $equipe->user_id=$request->input('RepresentantE&Pid');
        $equipe->post=2;
        $equipe->statut=1;
        $equipe->save();
        }

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

            $chef=null;
            $rep=null;
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


            if ($project->phase==4) { $request->validate([ "RegionTest" => "required",]); }

            if ($project->phase==5) {$request->validate([ "RegionTest" => "required",]); $request->validate([ "RegionImp" => "required",]);}

            if ($project->phase==6) {$request->validate([ "RegionTest" => "required",]); $request->validate([ "RegionImp" => "required",]); $request->validate([ "RegionExp" => "required",]);}


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

                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$x)->where('post','=',3);

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





            if ($request->input('Chefid')!=null) {


                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$request->input('Chefid'))->where('post','=',1);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);

                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $id;
                    $equipe->user_id=$request->input('Chefid');
                    $equipe->post=1;
                    $equipe->statut=1;
                    $equipe->save();
                }

            }

            if ($request->input('RepresentantE&Pid')!=null) {
                $temp=UserProject::where('project_id','=',$id)->where('user_id','=',$request->input('RepresentantE&Pid'))->where('post','=',2);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);

                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $id;
                    $equipe->user_id=$request->input('RepresentantE&Pid');
                    $equipe->post=2;
                    $equipe->statut=1;
                    $equipe->save();
                }
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
            $names[]='P:-'.$val->nom_projet;
            $vis[]=$val->visibilite;
            $reac[]=$val->reactivite;
            $avan[]=$val->avancement;
        }


        }else{


            $switch=request()->input('var');
            $date=request()->input('x');

            $recoveredArray=false;

            if (file_exists( Storage::path('archiveVRA/'.$date.' Idee RD.txt') ))
            {
                $recoveredData1 =  file_get_contents(Storage::path('archiveVRA/'.$date.' Idee RD.txt'));

                $recoveredArray1 = unserialize($recoveredData1);

                $i=1;

                while (isset($recoveredArray1[$i])) {

                    $names1[]='p: '.$recoveredArray1[$i];
                    $vis1[]=$recoveredArray1[$i+1];
                    $reac1[]=$recoveredArray1[$i+2];
                    $avan1[]=$recoveredArray1[$i+3];
                    $i=$i+4;

                }

                $count1=($i-1)/4;
            }



            if (file_exists( Storage::path('archiveVRA/'.$date.' Maturation.txt')))
            {
                 $recoveredData2 = file_get_contents(Storage::path('archiveVRA/'.$date.' Maturation.txt'));

                 $recoveredArray2 = unserialize($recoveredData2);

                 $i=1;

                 while (isset($recoveredArray2[$i])) {

                     $names2[]='p: '.$recoveredArray2[$i];
                     $vis2[]=$recoveredArray2[$i+1];
                     $reac2[]=$recoveredArray2[$i+2];
                     $avan2[]=$recoveredArray2[$i+3];
                     $i=$i+4;

                 }

                 $count2=($i-1)/4;
            }



            if (file_exists( Storage::path('archiveVRA/'.$date.' Recherche.txt')))
            {
                $recoveredData3 = file_get_contents(Storage::path('archiveVRA/'.$date.' Recherche.txt'));

                $recoveredArray3 = unserialize($recoveredData3);

                $i=1;

                while (isset($recoveredArray3[$i])) {

                    $names3[]='p: '.$recoveredArray3[$i];
                    $vis3[]=$recoveredArray3[$i+1];
                    $reac3[]=$recoveredArray3[$i+2];
                    $avan3[]=$recoveredArray3[$i+3];
                    $i=$i+4;

                }

                $count3=($i-1)/4;
            }




            if (file_exists( Storage::path('archiveVRA/'.$date.' Test.txt')))
            {
                $recoveredData4 = file_get_contents(Storage::path('archiveVRA/'.$date.' Test.txt'));

                $recoveredArray4 = unserialize($recoveredData4);

                $i=1;

                while (isset($recoveredArray4[$i])) {

                    $names4[]='p: '.$recoveredArray4[$i];
                    $vis4[]=$recoveredArray4[$i+1];
                    $reac4[]=$recoveredArray4[$i+2];
                    $avan4[]=$recoveredArray4[$i+3];
                    $i=$i+4;

                }

                $count4=($i-1)/4;
            }



            if (file_exists( Storage::path('archiveVRA/'.$date.' Implementation.txt') ))
            {
                $recoveredData5 = file_get_contents(Storage::path('archiveVRA/'.$date.' Implementation.txt'));

                $recoveredArray5 = unserialize($recoveredData5);

                $i=1;

                while (isset($recoveredArray5[$i])) {

                    $names5[]='p: '.$recoveredArray5[$i];
                    $vis5[]=$recoveredArray5[$i+1];
                    $reac5[]=$recoveredArray5[$i+2];
                    $avan5[]=$recoveredArray5[$i+3];
                    $i=$i+4;

                }

                $count5=($i-1)/4;
            }





        switch ($switch) {
            case '1':
                $recoveredArray=$recoveredArray1;
                $names=$names1;
                $vis= $vis1;
                $reac=$reac1;
                $avan=$avan1;
                break;
            case '2':
                $recoveredArray=$recoveredArray2;
                $names=$names2;
                $vis= $vis2;
                $reac=$reac2;
                $avan=$avan2;
                break;

            case '3':
                $recoveredArray=$recoveredArray3;
                $names=$names3;
                $vis= $vis3;
                $reac=$reac3;
                $avan=$avan3;

                break;

            case '4':
                $recoveredArray=$recoveredArray4;
                $names=$names4;
                $vis= $vis4;
                $reac=$reac4;
                $avan=$avan4;

                break;

            case '5':
                $recoveredArray=$recoveredArray5;$names=$names5;
                $vis= $vis5;
                $reac=$reac5;
                $avan=$avan5;

                break;


            default:

                break;
        }


        if (!$recoveredArray) {

            return redirect()->back()->withErrors('Archive non existent');
        }



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

            // 'region_test'=> $request->input('RegionTest'),
            //     'region_implementation'=> $request->input('RegionImp'),
            //     'region_exploitation'=> $request->input('RegionExp'),
            if ($project->phase==4) { if ($project->region_test=="") {return back()->withErrors("saisissez la region de test");} }
            if ($project->phase==5) { if ($project->region_implementation=="") {return back()->withErrors("saisissez la region d'implementation");} }

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

        return view('projets/historique_eq',['membres'=>$membre,'chefs'=>$chef,'reps'=>$rep,'id'=>$id]);
    }




}





