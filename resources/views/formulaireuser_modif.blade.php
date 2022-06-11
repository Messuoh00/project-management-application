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


																
																	 
																	<h6 class="mb-0"> division:</h6>

																	<div class="form-group input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text"> <i class="fa fa-building"></i> </span>
																		</div>
																		<select class="form-control form-select" name="division" id="division">
																			<option value="{{ $user->division->id}}" selected  >{{ $user->division->nomdep}}</option>	
																			
																			@foreach ($dep as $d)
						
																			@if (   $user->division->nomdep!=$d->nomdep ) 
																			<option value="{{$d->id}}"  >{{$d->nomdep}}</option>
																			@endif
						
																			@endforeach
																		</select>
																	</div>
																	<a style="margin-top: 10px; margin-bottom:10px" data-toggle="modal" href="#myModal10" class="btn btn-warning">selectionner le role</a>

                                                                                                    <div id="divnomrole" style="position:relative" class="form-control">@if($user->role!=null){{$user->role->nom_role}}<i onclick="enleverrole()"style="color:red;cursor:pointer;position:absolute; top:30%; right:10px" class=" iconetimes fa fa-times"  aria-hidden="true"></i>@endif
                                                                                                        
                                                                                                    
                                                                                             
                                                                                                    

                                                                                                    </div>
																									@if($user->role!=null)
                                                                                                    <input id="inputidrole" name="role" type="hidden"  value="{{$user->role->id}}" >
																									@else
																									<input id="inputidrole" name="role" type="hidden" >
																									@endif
                                                                                                    @if($errors->has('role'))
                                                                                                        <div><span style="color: red">{{$errors->first('role')}}</span></div>
                                                                                                                @endif
																	
																									<button style="margin-top: 10px ;" type="submit" class="btn btn-warning">Enregistrer</button>


																</form> 

																</div>
																		





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
							<div class="modal" tabindex="-1" role="dialog" id="myModal10">
                                                                                                                        <div class="modal-dialog" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <h5 class="modal-title">ajouter un role</h5>
                                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                            <h6 class="mb-0"> liste des accès :</h6>
                                                                                                                            <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                                                                                            <thead>
                                                                                                                                    <tr>
                                                                                                                                    <th scope="col" data-sortable="true">nom du role </th>  
                                                                                                                                           
                                                                                                                                    
                                                                                                                                    </tr>
                                                                                                                                </thead>
                                                                    
                                                                                                                                <tbody>
                                                                                                                                
                                                                                                                                @foreach($roles as $role)
                                                                                                                                
                                                                                                                                <tr>
                                                                                                                                <td > <div data-dismiss='modal' class="row_role_nom" style="width:100%;padding:25px;cursor:pointer"  onclick="selectionnerrole(this,{{$role->id}})" >{{$role->nom_role}}</div></td>
                                                                                                                            
                                                                                                                                
                                                                                                                                
                                                                    
                                                                                                                                <!-- Modal -->
                                                                                        
                                                                                                                                </tr>
                                                                                                                                @endforeach
                                                                                                                            </tbody>
                                                                                                                            </table>
                                                                
                                                                                     
                                                                                                                            
                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div> 
                                                             </div>
															 <script>
                               row_role_nom=document.getElementsByClassName('row_role_nom');
                               console.log(row_role_nom[0].innerHTML);
                               divrole=document.getElementById('divnomrole');
                               console.log(divrole.innerHTML);
                                   input_id_role=document.getElementById('inputidrole');
                               function selectionnerrole(caller,id){
                                   
                                  
                                   
                                   
                                   divrole.innerHTML=caller.innerHTML +'<i onclick="enleverrole()"style="color:red;cursor:pointer;position:absolute; top:30%; right:10px" class=" iconetimes fa fa-times"  aria-hidden="true"></i>';
                                   input_id_role.value=id;
                               }
                               function enleverrole(){
                                   divrole.innerHTML='';
                                   input_id_role.value=null;
                               }
							   </script>


@endsection