<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Division;



class Authcontroller extends Controller
{    //vue sur le formulaire du login
    function log(){

      
     return view('login');        
    }
    //traitement du login
    function login(Request $request){
        $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required'
        ]);
     $userdata=array(
        'email' =>$request->get('email'),
        'password' =>$request->get('password')
     );
     if (Auth::attempt($userdata)){
       
        return redirect('/apreslogin');
     }
     else{ return back()->with('error','adresse email ou mot de passe incorrect');}
    }
    //ici la page principal apres le login
    function apreslogin(){
        return redirect('/coo-E&P');
    }

    //traitement du logout
    function logout(){
      Auth::logout();
      return redirect('/log');


    }

     //listes des users
    function index(){
       
        $users=User::all();

       
        return view('listeusers',['users'=>$users]);
    }


    //formulaire de creation du user
    function create(){

        $dep=Division::get(); 
        $roles=Role::all();
        return view('formulaireuser', ['dep'=>$dep,'roles'=>$roles]);
    }


    //creation du user
    function store(Request $request){
        
       
       
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'division' => 'required',
            'password2'=>'required',
            'role'=>'required'
   ]);
   if($request->password != $request->password2){ 
                
    return back()->with('error','confirmation du mot de passe incorrect');
} else{
   
    $user=User::create([
            'nom'=>$request->input('nom'),
            'prenom'=>$request->input('prenom'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'division_id'=>(int)$request->get('division'),
            'role_id'=>(int)$request->input('role'),
         ]);
        return redirect('/users/create');}
    }

    function show($id){
        $user=User::find($id);
       

        return view('formulaireuser_show')->with('user',$user);
        
    }
     //formulaire de modification du user
    function edit($id){
        $user=User::find($id);
        $dep=Division::get(); 
        $roles=Role::all();
        return view('formulaireuser_modif', ['dep'=>$dep,'user'=>$user,'roles'=>$roles]);


    }
    //modification du user
    function update($id,Request $request){
        
        $this->validate($request,[
            'email' => 'required|email|unique:users,email,'.$id,
            'nom' => 'required',
            'prenom' => 'required',
            'division' => 'required',
            'role'=>'required',
            
   ]);

   
        $user=User::where('id',$id)->update([
            'nom'=>$request->input('nom'),
            'prenom'=>$request->input('prenom'),
            'email'=>$request->input('email'),
            'division_id'=>(int)$request->get('division'),
            'role_id'=>(int)$request->input('role'),
             ]);
        

    
    return redirect("/users/$id/edit");
    }
    
    //formulaire modification du mot de passe
    function editpassword(){
        return view('updatepassword');
    }

    //modification du mot de passe
    function updatepassword(Request $request){
        $this->validate($request, [
 
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'newpassword2'=>'required',
            ]);
            if($request->newpassword != $request->newpassword2){ 
                
                return back()->with('error','confirmation du mot de passe incorrect');
            } else{

            
         
            $hashedPassword = Auth::user()->password;    
            if (Hash::check($request->oldpassword , $hashedPassword )) {
                  
                if (!Hash::check($request->newpassword , $hashedPassword)) {
                $id=Auth::user()->id;
                $user=User::where('id',$id)->update([ 'password'=> bcrypt($request->newpassword) ]);
                return redirect('/apreslogin');
                } else{
                    
                    return back()->with('error','le nouveau mot de passe ne peut pas rester le meme');
                  }
            }else{  
                return back()->with('error','ancien mot de passe incorrect ');
              } }


    }
    function destroy($id){
        $user=User::find($id);
        $user->delete();
        return redirect('users');

    }
    
    function importerfichierexcel(Request $request){
        
        if($request->hasFile('fichier')){
           
            $routedossier=storage_path('app\fichier-excel');
            File::cleanDirectory($routedossier);
            $nomfichier=$request->file('fichier')->getClientOriginalName();
             
            $route=$request->file('fichier')->storeAs('fichier-excel',$nomfichier);
        }

        return redirect('/users/create');

    }
    function editprofil($id ){
        if(Auth::user()->id==$id){

        
        $user=User::find($id);
        $dep=Division::get(); 
        
        return view('formulaireprofil_modif', ['dep'=>$dep,'user'=>$user]);}
        else{
            return redirect('/coo-E&P');
        }
    }
    function updateprofil($id,Request $request){
        if(Auth::user()->id==$id){
            $this->validate($request,[
                'email' => 'required|email|unique:users,email,'.$id,
                'nom' => 'required',
                'prenom' => 'required',
                
                
       ]);
       $user=User::where('id',$id)->update([
        'nom'=>$request->input('nom'),
        'prenom'=>$request->input('prenom'),
        'email'=>$request->input('email'),
         ]);
         return redirect('/profil/edit/'.$id);

        }else{ return redirect('/coo-E&P');

        }

    }

}
