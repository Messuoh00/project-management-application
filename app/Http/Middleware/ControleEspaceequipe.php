<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\acces;

class ControleEspaceequipe
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
        $user_id=Auth::user()->id;
        if(auth::user()->role==null){
          return abort(403);
      }
       $role_id=auth::user()->role->id;
       $tous_les_privileges=acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();
        if($tous_les_privileges!=null){
          return $next($request);
        }
       $acces_espace_equipe=acces::where('nom_acces','gérer les fichiers de espace equipe des projets accessibles en lecture')->whereRelation('roles','roles.id',$role_id)->get()->first();
        if($acces_espace_equipe!=null){
          return $next($request);
        }else{ return abort(403);}
    }
}
