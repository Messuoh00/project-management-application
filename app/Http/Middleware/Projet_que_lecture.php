<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

class Projet_que_lecture
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
        if (Auth::user()->poste=="relai"){
           
            $trouve=Project::where('id',$project_id)->where('structure_pilote',Auth::user()->division)->first();
            
            if($trouve==null){return abort(403);}
            else{return $next($request); }
            
         } else{
             if(Auth::user()->poste=="employé"){
                $user_id=Auth::user()->id;

                $trouve=Project::where('id',$project_id)->where(function($query) use ($user_id){$query->whereRelation('user','id',$user_id)->orWhere('chef_projet',$user_id)->orWhere('representant_EP',$user_id);})->first();
                if($trouve==null){return abort(403);}
                
             }
         } return $next($request);
    }
}
