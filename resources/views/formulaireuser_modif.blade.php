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
																
																
																	<hr>
																
																<form method="post" action="/users/{{$user->id}}/" >
																	{{csrf_field()}}
																	{{ method_field('PUT') }}
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


																
																	  <h6 class="mb-0"> poste:</h6>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
																		</div>
																		<select class="form-control form-select" name="poste" id="poste">
																			<option value="{{ $user->poste}}" selected  hidden>{{ $user->poste}}</option>
																			<option value="vice president">vice president</option>
																			<option value="Divisionnaire">Divisionnaire</option>
																			<option value="employé">employé</option>
																			<option value="relai">relai</option>
																			<option value="admin">admin</option>
																		</select>
																	</div>
																	<h6 class="mb-0"> division:</h6>

																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-building"></i> </span>
																		</div>
																		<select class="form-control form-select" name="division" id="division">
																			<option value="{{ $user->division}}" selected  hidden>{{ $user->division}}</option>	
																			
																			@foreach ($dep as $d)
						
																			@if (   $user->division!=$d->nomdep ) 
																			<option value={{$d->nomdep}}  >{{$d->nomdep}}</option>
																			@endif
						
																			@endforeach
																		</select>
																	</div>
																	
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