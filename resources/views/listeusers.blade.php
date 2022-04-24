@extends('layout.main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                                           
                                                        <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                        <thead>
                                                                <tr>
                                                                 <th scope="col" data-sortable="true">nom</th>  
                                                                 <th scope="col" data-sortable="true">prenom</th>
                                                                 <th scope="col" data-sortable="true">email</th>
                                                                 <th scope="col" data-sortable="true">poste</th>
                                                                 <th scope="col" data-sortable="true">divsion</th>
                                                                 <th scope="col" >modifier</th>
                                                                 <th scope="col" >supprimer</th>

                                                            
                                                                
                                                                
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            <tr>
                                                            @foreach($users as $user)
                                                            <td>{{$user->nom}}</td>
                                                            <td>{{$user->prenom}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>{{$user->poste}} </td>
                                                            <td>{{$user->division}} </td>
                                                            <td> <a class="btn btn-warning" href="/users/{{$user->id}}/edit">update</a>  </td>
                                                            <td> <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#exampleModal{{$user->id}}supp" > supprimer </a> </td>
                                                            

                                                            <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$user->id}}supp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"> voulez vous Supprimer l'utilisateur {{$user->nom}}?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                              
                              <form action="/users/{{$user->id}}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="button submit" class="btn btn-danger" >supprime</button>
                              </form>

                          </div>
                          </div>
                      </div>
                      </div>  
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        </table>
                                                        
                      

                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





@endsection