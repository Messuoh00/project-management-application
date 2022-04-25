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
                                                   
																																
																	
																<div class="container">
																
																
																	<hr>
																
																
																	<div class="form-group input-group">
																		
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input disabled id="nom" name="nom" class="form-control" value=" {{ $user->nom}}" type="text">
																	
																	</div>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-user"></i> </span>
																		</div>
																		<input disabled id="prenom" name="prenom" class="form-control" value=" {{ $user->prenom}}" type="text">
																	</div>
																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
																		</div>
																		<input disabled id="email" name="email" class="form-control" value=" {{ $user->email}}" type="email">
																	</div>

																

																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
																		</div>
																		<select disabled class="form-control form-select" name="poste" id="poste">
																			<option value="{{ $user->poste}}" selected  hidden>{{ $user->poste}}</option>
																			<option value="vice president">vice president</option>
																			<option value="Divisionnaire">manager</option>
																			<option value="employé">employé</option>
																			<option value="relai">employé</option>
																			<option value="admin">admin</option>
																		</select>
																	</div>

																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-building"></i> </span>
																		</div>

																		<input disabled id="division" name="division" class="form-control" value=" {{$user->division}}" type="text">
																		
																	</div>
																				
                                                                    <a style="float: right" href="/publications/profil/{{$user->id}}"  class="btn btn-warning"> Publications </a>


																

																</div>
																		





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



@endsection