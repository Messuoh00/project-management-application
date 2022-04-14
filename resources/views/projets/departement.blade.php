@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Modifier Departement:</h1>    
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                  
                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                         
                                                        <thead>
                                                            <th></th>
                                                            
                                                        </thead>
 
                                                        <tbody >
 
                                                            @foreach ($dep as $d)
                                                            <tr >
                                                                    <td>
                                                                        
                                                                        <b>{{$d->nomdep}}</b> 
                                               
                                                                        <div style="float: right">
                                                                            <form action="/Departement/{{$d->id}}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="button submit" class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir supprimer ce Departement?');">supprime</button>
                                                                            </form>
                                                                          
                                                                      
                                                                        </div>

                                                                    </td>
                                                                
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        
                                                    </table> 



                                                    <form action="{{route('Departement.store')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                     <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px">Ajouter Departement</a> 
                                                    <div class="modal" tabindex="-1" role="dialog" id="myModal3">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">Equipe</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                                           
                                                                <b>Nom du nouveau Departement:</b>
                                                                <input type="text" class="form-control" placeholder="NomDep" name="nomdep"/>            
                                                            </div>
                    
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Feremr</button>
                                                            <button type="button submit" class="btn btn-warning">ok</button>
                                                        
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                    
                                                                            

                                                    </form>



                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





@endsection

