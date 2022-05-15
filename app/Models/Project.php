<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    public function user(){

        return  $this->belongsToMany(User::class);

    }

    function Phase(){

        return $this->belongsTo(Phase::class);
    }


    function departement(){


        return $this->belongsTo(Departement::class);
    }


    public function createvra($request){


        $exist=Vra::get()->where('visibilite',$request->input('Visibilite'))->where('reactivite',$request->input('Reactivite'))->where('avancement',$request->input('Avancement'))->where('phase_id',$this->phase_id)->where('project_id',$this->project_id)->first();

        if (empty($exist))
        {



        $va=new Vra();
        $va->project_id=$this->id;
        $va->phase_id=$this->phase_id;


        if ($request->has('Visibilite')) {
            $va->visibilite= $request->input('Visibilite');
        }

        if ($request->has('Reactivite')) {
            $va->reactivite= $request->input('Reactivite');
        }

        if ($request->has('Avancement')) {
            $va->avancement= $request->input('Avancement');
        }


        $va->save();

        }

    }


    public function getequipe(){



        $chef=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where  statut=1 and post=1 and project_id='".$this->id."'
        )

        ");

        if (!empty($chef)) {
            $chef=$chef[0];
        }



        $rep=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where statut=1 and post=2 and  project_id='".$this->id."'
        )

        ");

        if (!empty($rep)) {
            $rep=$rep[0];
        }


        $equipe=DB::select("

        select nom,prenom,id from users where id IN

        (
            select user_id from project_user
            where statut=1 and post=3 and  project_id='".$this->id."'
        )

        ");


        $results=array(0=>$chef,1=>$rep,2=>$equipe);



        return $results;

    }


    public function createquipe($request)
    {
        if ($request->input('Chefid')!=null) {


            $equipe=new UserProject();
            $equipe->project_id= $this->id;
            $equipe->user_id=$request->input('Chefid');
            $equipe->post=1;
            $equipe->statut=1;
            $equipe->save();
            }

        if ($request->input('RepresentantE&Pid')!=null) {

            $equipe=new UserProject();
            $equipe->project_id= $this->id;
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
            $equipe->project_id= $this->id;
            $equipe->user_id=$x;
            $equipe->post=3;
            $equipe->statut=1;
            $equipe->save();
        }
        }
    }



    public function updateequipe($request)
    {

            DB::table('project_user')->where('project_id', $this->id)->update(['statut' =>0]);

            $xs= $request->input('equipeid');
            $array = explode(',',$xs[0]);

            foreach ($array as $x) {

                if(!empty($x)){

                $temp=UserProject::where('project_id','=',$this->id)->where('user_id','=',$x)->where('post','=',3);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);

                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $this->id;
                    $equipe->user_id=$x;
                    $equipe->post=3;
                    $equipe->statut=1;
                    $equipe->save();
                }


                }
            }

            if ($request->input('Chefid')!=null) {


                $temp=UserProject::where('project_id','=',$this->id)->where('user_id','=',$request->input('Chefid'))->where('post','=',1);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);

                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $this->id;
                    $equipe->user_id=$request->input('Chefid');
                    $equipe->post=1;
                    $equipe->statut=1;
                    $equipe->save();
                }

            }

            if ($request->input('RepresentantE&Pid')!=null) {
                $temp=UserProject::where('project_id','=',$this->id)->where('user_id','=',$request->input('RepresentantE&Pid'))->where('post','=',2);

                if ($temp->exists()) {
                 $temp->update(['statut' =>1]);

                }else{

                    $equipe=new UserProject();
                    $equipe->project_id= $this->id;
                    $equipe->user_id=$request->input('RepresentantE&Pid');
                    $equipe->post=2;
                    $equipe->statut=1;
                    $equipe->save();
                }
            }

    }




    protected $fillable = [
        'nom_projet',
        'abreviation' ,
        'thematique',
        'structure_pilote',
        'Phase_id',
        'files',
        'region_test',
        'region_implementation',
        'region_exploitation',

        'budget',

        'date_deb',
        'date_fin',

        'chef_projet',
        'equipe' ,
        'representant_EP' ,

        'etude_echo'  ,


        'visibilite',
        'reactivite',
        'avancement',

        'description',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

}
