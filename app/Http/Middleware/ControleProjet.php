<?php

namespace App\Http\Middleware;

use App\Models\UserProject;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ControleProjet
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
      if (Auth::user()->poste=="admin"||Auth::user()->poste=="vice president"||Auth::user()->poste=="Divisionnaire"){
            
        return $next($request);
     }
      $project_id=$request->route()->parameter('projet');
      $user_id=Auth::user()->id;
      $trouve=Project::where('id',$project_id)->whereRelation('user','id',$user_id)->latest()->first();
      
      if($trouve!=null){
        $trouve2=UserProject::where('project_id',$project_id)->where('user_id',$user_id)->where('statut',1)->where(function($query){$query->where('post',1)->orWhere('post',2);})->first();
        if ($trouve2!=null){return $next($request); }else{ return abort(403);}
      } else{  return abort(403);

      }
      
     //$trouve=UserProject::where('user_id',$user_id)->where('project_id',$project_id)->first();
     
      

        
    }
}
