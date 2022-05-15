<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserProject;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ControleProjetlecture
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
        if (Auth::user()->poste=="relai"||Auth::user()->poste=="Divisionnaire"){
           
            $trouve=Project::where('id',$project_id)->where('structure_pilote',Auth::user()->division);
            
            if($trouve==null){return abort(403);}
            else{return $next($request); }
            
         } else{
             if(Auth::user()->poste=="employé"){
                $user_id=Auth::user()->id;

                $trouve=Project::where('id',$project_id)->where(function($query) use ($user_id){$query->whereRelation('user','id',$user_id);})->latest()->first();
                if($trouve==null){return abort(403);} else{
                    $trouve2=UserProject::where('project_id',$project_id)->where('user_id',$user_id)->where('statut',1)->first();
                    if($trouve2==null){return abort(403);

                    }
                }
                
             }
         } return $next($request);
        
    }
}
