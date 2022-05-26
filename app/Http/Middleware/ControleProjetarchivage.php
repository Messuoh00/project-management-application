<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\acces;
use App\Models\UserProject;
use App\Models\Project;
class ControleProjetarchivage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $project_id=$request->route()->parameter('projet');
        $user_id=Auth::user()->id;
        if(auth::user()->role==null){
            return abort(403);

        }
        $role_id=auth::user()->role->id;
        $acces_archivage=acces::where('nom_acces','archivage projet accessible')->whereRelation('roles','roles.id',$role_id)->get()->first();



        $tous_les_privileges=acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();
        if($tous_les_privileges!=null){
          return $next($request);
        }
  

  
        $acces_lecture_tous_les_projets=acces::where('nom_acces','lecture de tous les projets')->whereRelation('roles','roles.id',$role_id)->get()->first();
  
        if($acces_lecture_tous_les_projets!=null&&$acces_archivage!=null){
          return $next($request);
        }
  


      $acces_lecture_par_division=acces::where('nom_acces','lecture de projets de la meme division')->whereRelation('roles','roles.id',$role_id)->get()->first();
      if($acces_lecture_par_division!=null&&$acces_archivage!=null){
        $trouve_par_division=Project::where('id',$project_id)->where('division_id',auth::user()->division->id)->get()->first();;
        if($trouve_par_division!=null){
          return $next($request);
        }
      }


      $acces_lecture=acces::where('nom_acces','lecture de projet affecté')->whereRelation('roles','roles.id',$role_id)->get()->first();
    if($acces_lecture!=null&&$acces_archivage!=null){
        $trouve=Project::where('id',$project_id)->where(function($query) use ($user_id){$query->whereRelation('user','id',$user_id);})->latest()->first();
      
      if($trouve!=null){
        $trouve2=UserProject::where('project_id',$project_id)->where('user_id',$user_id)->where('statut',1)->first();
        if ($trouve2!=null){return $next($request); }else{ return abort(403);}
      } else{  return abort(403);

      }
    } else{return abort(403);}

    }
}
