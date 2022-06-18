<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

use App\Mail\forgotpassword;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Division;
use Carbon\Carbon;

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
     if($request->sesouvenir!=null){
         $remember=true;
     } else {$remember=false;}
     if (Auth::attempt($userdata,$remember)){

        return redirect('/coo-E&P');
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

        $dep=Division::get()->where('stat','=',1);
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
        return back()->with('success','utilisateur créé avec succès ');}
    }

    function show($id){
        $user=User::find($id);


        return view('formulaireuser_show')->with('user',$user);

    }
     //formulaire de modification du user
    function edit($id){
        $user=User::find($id);
        $dep=Division::get()->where('stat','=',1);
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



    return back()->with('success','les données ont eté modifié avec succès ');
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
                return back()->with('success','le mot de passe a eté modifié');
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
        $dep=Division::get()->where('stat','=',1);

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
         return back()->with('success','vous données ont eté modifié avec succès ');

        }else{ return redirect('/coo-E&P');

        }

    }
    function envoiresetpassword(){
        return view('formulaire_reset_password');
    }
    function resetpassword(Request $request){
        $this->validate($request,[
            'email' => 'required|email',]);
            $user_exist=User::where('email',$request->email)->first();

            if($user_exist==null){

                return back()->with('error',"il n'existe pas un utilisateur avec cet email");
            }
            $token=\Str::random(64);
            DB::table('password_resets')->insert([
                'email'=>$request->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);
            $actionlink=route('reset.password.form',['token'=>$token,'email'=>$request->email]);


            $body="nous avons reçu une demande de réinitialisation de mot de passe de l'application gestion des projets R&D pour le compte associé avec l'email".$request->email.". Vous pouvez réinitialiser le mot de passe en cliquant sur le lien en dessous";

            //houssem

            $data=array($body,$actionlink);



            Mail::to($user_exist->email)->send(new forgotpassword($data));

            //houssem

            return back()->with('success','nous avons envoyé un mail pour réinitialiser votre mot de passe');

    }
    function resetpasswordform(Request $request,$token=null){
        return view('updatepassword_oublié')->with(['token'=>$token,'email'=>$request->email]);
    }
    function resetpasswordfinal(Request $request){
        $this->validate($request, [

            'newpassword' => 'required',
            'newpassword2'=>'required',
            ]);


            if($request->newpassword != $request->newpassword2){

                return back()->with('error','confirmation du mot de passe incorrect');
            } else{

                $check_token=DB::table('password_resets')->where(['email'=>$request->email,'token'=>$request->token])->first();
                if(!$check_token){
                    return back()->with('error','token non valide');

                }
                else{

                    User::where('email',$request->email)->update([
                        'password'=>Hash::make($request->newpassword),
                    ]);
                    DB::table('password_resets')->where(['email'=>$request->email])->delete();
                    return redirect('/log')->with('success_reset','votre mot de passe a eté réinitialisé! vous pouvez vous connecter avec.');
                }
            }

    }

}
