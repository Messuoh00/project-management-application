<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\acces;
use App\Models\acces_role;


class RoleController extends Controller
{
    //
    function create(){
        return view('role/formulairerole');
    }
    function store(Request $request){
        $this->validate($request,[
           
            'nom_role' => 'required',
        ]);
        $role=Role::create([
            'nom_role'=>$request->input('nom_role'),
        ]);
        return redirect('roles');
    }
    function index (){
        $roles=Role::all();
        return view('role/listeroles',['roles'=>$roles]);
    }
    function edit($id){
        $role=Role::find($id);
        $touslesacces=acces::all();
        $acces=[];
        foreach($touslesacces as $unacces){
            $testacces=acces_role::where('acces_id',$unacces->id)->where('role_id',$role->id)->latest()->first();
            if($testacces==null){
                $acces[]=$unacces;
            }
        }
        
        
        return view ('role/formulairerole_modif',['role'=>$role,'acces'=>$acces]);
    }
    function update($id,Request $request){
        $this->validate($request,[
           
            'nom_role' => 'required',
        ]);
        $role=Role::where('id',$id)->update([
            'nom_role'=>$request->input('nom_role'),
        ]);
        return redirect('/roles/'.$id.'/edit');

    }
    function ajouter_acces($id,Request $request){
        
        acces_role::create([
            'role_id'=>$id,
            'acces_id'=>(int)$request->input('acces_id'),
        ]);
        return redirect('/roles/'.$id.'/edit');

    }
    function supprimer_acces($id,$accesid){
       
        $supp=acces_role::where('role_id',$id)->where('acces_id',$accesid);
        if($supp!=null){
            $supp->delete();
        }
        return redirect('/roles/'.$id.'/edit');

    }
    function destroy($id){
        
        $role=Role::find($id);
       
        if($role->users->first()!=null){
            return back()->with('erreursup','vous nous pouvez pas supprimer ce role car il est affecté a un employé'); 
        }
        $role->delete();
        return redirect('roles');
    }
    
}
