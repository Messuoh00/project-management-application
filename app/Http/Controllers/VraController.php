<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vra;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Departement;


class VraController extends Controller
{

    public function index(Request $request)
    {



        $phases=array();
        $counts=array();
        $counts1=array();

        $ph=Phase::orderBy('position')->get()->whereNotNull('position');

        foreach ($ph as $p) {
            $phases[]=$p->name;
            $counts1[$p->name]=0;
         }




        $projets=Project::latest()->get();

        $temp=array();


        foreach ($projets as $projet) {

            $test=true;

            if ($request->has('month'))
            {

                if ($request->input('month')<now()) {

                $x=Vra::latest()->get()->where('project_id','=',$projet->id)->where('created_at','<=',$request->input('month'))->first();

                }

            }else {

                $x=Vra::latest()->get()->where('project_id','=',$projet->id)->where('phase_id','=',$projet->phase_id)->first();

            }

            if (!empty($x)) {

           if ($request->has('phase'))
           {
            if($x->phase_id!=$request->input('phase')){$test=false;}
            }

            if ($request->has('stp'))
            {
            if($x->project->departement_id!=$request->input('stp')){$test=false;}
            }

            if ($request->has('echo'))
            {
            if($x->project->etude_echo!=$request->input('echo')){$test=false;}
            }


            if ($test) {

                    $temp[]=$x;

            }


           $counts1[$x->phase->name]=$counts1[$x->phase->name]+1;

          }
        }



        foreach ($counts1 as $c) {
            $counts[]=$c;
        }

        $names=array();

        $vis=array();

        $reac=array();

        $avan=array();


        foreach ($temp as $t) {
            $names[]=$t->project->nom_projet;

            $vis[]=$t->visibilite;

            $reac[]=$t->reactivite;

            $avan[]=$t->avancement;
        }


        $dep=Departement::get()->where('stat','=',1);
        return view('projets.stats',compact('counts','phases','names','vis','reac','avan','dep'));
    }




    public function show($id)
    {
        $project=Project::find($id);

        $result=Vra::get()->where('project_id','=',$project->id);


        $dates=array();

        $names=array();

        $vis=array();

        $reac=array();

        $avan=array();

        $prev=$result->first()->phase->name;

        foreach ($result as $r) {


            if ($prev!=$r->phase->name) {

                $dates[]=substr($r->created_at,0,10).' debut phase: '.$r->phase->name;
            }else{
                $dates[]=substr($r->created_at,0,10);
            }

            $vis[]=$r->visibilite;

            $reac[]=$r->reactivite;

            $avan[]=$r->avancement;

            $prev=$r->phase->name;

        }



        return view('projets.statisticprojet',compact('result','project','dates','vis','reac','avan'));



    }


}
