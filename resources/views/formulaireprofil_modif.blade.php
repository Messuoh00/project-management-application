@extends('layout.main')


@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >



@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"> modification d'un utilisateur</h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col x">
                                                   
																																
																	
																<div class="container">
																@if($message=Session::get('success'))
                                                                                    
                                                                                    
                                                                                        
                                                                                    <div><span style="color: green">{{Session::get('success')}}</span></div>
                                                                                            @endif
                                                                            
																
																
																	<hr>
																
																<form method="post" action="/profil/update/{{$user->id}}" >
																	{{csrf_field()}}
																	{{ method_field('PATCH') }}
																	<h6 class="mb-0"> nom:</h6>
																	<div class="form-group input-group">
																		
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input id="nom" name="nom" class="form-control" value=" {{ $user->nom}}" type="text">
																	
																	</div>
																	@if($errors->has('nom'))
																	<div><span style="color: red">{{$errors->first('nom')}}</span></div>
																	@endif
																	<h6 class="mb-0"> prenom:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input id="prenom" name="prenom" class="form-control" value=" {{ $user->prenom}}" type="text">
																	</div>
																	@if($errors->has('prenom'))
                                                                        <div><span style="color: red">{{$errors->first('prenom')}}</span></div>
                                                                   @endif
																   <h6 class="mb-0"> email:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
																		</div>
																		<input id="email" name="email" class="form-control" value=" {{ $user->email}}" type="email">
																	</div>
																	@if($errors->has('email'))
                                                                         <div><span style="color: red">{{$errors->first('email')}}</span></div>
                                                                      @endif


																
																	  
																	
																	<button type="submit" class="btn btn-warning">Enregistrer</button>

																</form> 

																</div>
																		





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



@endsection