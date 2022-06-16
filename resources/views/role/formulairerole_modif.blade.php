@extends('layout.main')


@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >



@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"> modification d'un role</h1>
                               
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
																
																<form method="post" action="/roles/{{$role->id}}/" >
																	{{csrf_field()}}
																	{{ method_field('PUT') }}
																	<h6 class="mb-0"> nom du role:</h6>
																	<div class="form-group input-group">
																		
																	
																		<input id="nom" name="nom_role" class="form-control" value=" {{ $role->nom_role}}" type="text">
																	
																	</div>
																	@if($errors->has('nom_role'))
																	<div><span style="color: red">{{$errors->first('nom_role')}}</span></div>
																	@endif

																	
																	<button type="submit" class="btn btn-warning">enregistrer le nom</button>

																</form> 

																</div>
                                                                <h6 class="mb-0"> liste des accès:</h6>
                                                        <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                        <thead>
                                                                <tr>
                                                                 <th scope="col" data-sortable="true">nom de l'accès </th>  
                                                                 <th scope="col" data-sortable="true">supprimer </th> 
                                                                 

                                                             

                                                            
                                                                
                                                                
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            @foreach($role->acces as $unacces)
                                                                <tr>

                                                                <td > <div style="width:100%;padding:25px;"   > {{$unacces->nom_acces}} </div></td>
                                                                <td > <div    > <a class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir supprimer cet accès?');" href="/supprimeracces/{{$role->id}}/{{$unacces->id}}"> supprimer </a>  </div></td>


                                                                </tr>

                                                                @endforeach
                                                        
                                                        </tbody>
                                                        </table>




                                                        <button class="btn btn-warning" data-toggle="modal" href="#myModal">ajouter un accès </button> 
                                                        <div class="modal" tabindex="-1" role="dialog" id="myModal">
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
                                                                                                                                        <th scope="col" data-sortable="true">nom de l'accès </th>  
                                                                                                                                        
                                                                                                                                        

                                                                                                                                    

                                                                                                                                    
                                                                                                                                        
                                                                                                                                        
                                                                                                                                        </tr>
                                                                                                                                    </thead>

                                                                                                                                    <tbody>
                                                                                                                                    @foreach($acces as $unacces)
                                                                                                                                        <tr>

                                                                                                                                        <td > <div style="width:100%;padding:25px;cursor:pointer" onclick="ajouteracces({{$unacces->id}},this)"  > {{$unacces->nom_acces}} </div></td>

 
                                                                                                                                        </tr>
                                                                                                                                        

                                                                                                                                        @endforeach
                                                                                                                                
                                                                                                                                </tbody>
                                                                                                                                </table>
                                                                                                                                <form id="form_acces" method="post" action="/roles/{{$role->id}}/ajouter_acces" >
                                                                                                                                {{csrf_field()}}
                                                                                                                                {{ method_field('PUT') }}
                                                                                                                                <input id="acces_id"name="acces_id" type="hidden">
                                                                                                                                </form>
                                                                                                                            
                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div> 
                                                             </div>  



																		





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script>
                                input=document.getElementById('acces_id');
                                form=document.getElementById('form_acces');
                                function ajouteracces(id,caller){
                                    input.value=id;
                                  
                                  form.submit();
                                  caller.onclick=null;

                                }
                            </script>



@endsection