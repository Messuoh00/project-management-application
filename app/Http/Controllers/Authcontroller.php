<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\Departement;



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
        return view('aff');
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

        $dep=Departement::get(); 
        return view('formulaireuser', ['dep'=>$dep]);
    }


    //creation du user
    function store(Request $request){
       
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'nom' => 'required',
            'prenom' => 'required',
            'poste' => 'required',
            'division' => 'required',
   ]);
    $user=User::create([
            'nom'=>$request->input('nom'),
            'prenom'=>$request->input('prenom'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'poste'=>$request->get('poste'),
            'division'=>$request->get('division'),
         ]);
        return redirect('/users/create');
    }

    function show($id){
        $user=User::find($id);
       

        return view('formulaireuser_show')->with('user',$user);
        
    }
     //formulaire de modification du user
    function edit($id){
        $user=User::find($id);
        $dep=Departement::get(); 
        return view('formulaireuser_modif', ['dep'=>$dep,'user'=>$user]);


    }
    //modification du user
    function update($id,Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:users,email,'.$id,
            'nom' => 'required',
            'prenom' => 'required',
            'poste' => 'required',
            'division' => 'required',
            
   ]);
   $user=User::where('id',$id)->update([
    'nom'=>$request->input('nom'),
    'prenom'=>$request->input('prenom'),
    'email'=>$request->input('email'),
    'poste'=>$request->get('poste'), 
    'division'=>$request->get('division'),
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
    

}
