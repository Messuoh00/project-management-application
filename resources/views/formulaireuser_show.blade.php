@extends('layout.main')


@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >



@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Profil utilisateur</h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col x">
												@php
    $user_id=Auth::user()->id;
      if(auth::user()->role==null){
        $role_id=0;
    }
	else{
     $role_id=auth::user()->role->id;}
     $main_tous_les_privileges= App\Models\acces::where('nom_acces','tous les privileges')->whereRelation('roles','roles.id',$role_id)->get()->first();
     $main_acces_gestion_utilisateur=App\Models\acces::where('nom_acces','gestion des utilisateurs')->whereRelation('roles','roles.id',$role_id)->get()->first();

    @endphp
                                                   
																																
																	
																<div class="container">
																
																
																	<hr>
																
																    <h6 class="mb-0"> nom:</h6>
																	<div class="form-group input-group">
																	
																		
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input disabled id="nom" name="nom" class="form-control" value=" {{ $user->nom}}" type="text">
																	
																	</div>
																	<h6 class="mb-0"> prenom:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input disabled id="prenom" name="prenom" class="form-control" value=" {{ $user->prenom}}" type="text">
																	</div>
																	<h6 class="mb-0"> email:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
																		</div>
																		<input disabled id="email" name="email" class="form-control" value=" {{ $user->email}}" type="email">
																	</div>

																
																	@if($main_tous_les_privileges!=null||$main_acces_gestion_utilisateur!=null)

																	<h6 class="mb-0"> role:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
																		</div>
																		<input disabled id="role" name="role" class="form-control" value="{{$user->role->nom_role}}" type="text">

																	</div>
																	<h6 class="mb-0"> division:</h6>

																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-building"></i> </span>
																		</div>

																		<input disabled id="division" name="division" class="form-control" value=" {{$user->division->nomdep}}" type="text">
																		
																	</div>
																	@endif
																				
                                                                    <a style="float: right" href="/publications/profil/{{$user->id}}"  class="btn btn-warning"> Publications </a>
																	<a style="margin-right:10px;float: right" href="/connaissances/profil/{{$user->id}}"  class="btn btn-warning"> Connaissances </a>
																	<a style="margin-right:10px;float: right" href="/projets/profil/{{$user->id}}"  class="btn btn-warning"> Projets affectés </a>


																

																</div>
																		





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



@endsection