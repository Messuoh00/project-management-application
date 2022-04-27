@extends('layout.main')


@section('styles')


<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >


@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"> Creation d'un utilisateur</h1>
                                
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                                                                                                                
                                                                                              
                                                                                                <div class="container">
                                                                                                
                                                                                                
                                                                                                    <hr>
                                                                                                
                                                                                                <form method="post" action="{{url('/users')}}" >
                                                                                                    {{csrf_field()}}
                                                                                                    <div class="form-group input-group">
                                                                                                        
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="nom" name="nom" class="form-control" placeholder="nom" type="text">
                                                                                                       
                                                                                                    
                                                                                                    </div>
                                                                                                    @if($errors->has('nom'))
                                                                                                        <div><span style="color: red">{{$errors->first('nom')}}</span></div>
                                                                                                                @endif
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="prenom" name="prenom" class="form-control" placeholder="prenom" type="text">
                                                                                                    </div>
                                                                                                    @if($errors->has('prenom'))
                                                                                                        <div><span style="color: red">{{$errors->first('prenom')}}</span></div>
                                                                                                                @endif
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="email" name="email" class="form-control" placeholder="adresse email" type="email">
                                                                                                    </div>
                                                                                                    @if($errors->has('email'))
                                                                                                        <div><span style="color: red">{{$errors->first('email')}}</span></div>
                                                                                                                @endif

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="password" name="password" class="form-control" placeholder="mot de passe " type="password">
                                                                                                    </div>
                                                                                                    @if($errors->has('password'))
                                                                                                        <div><span style="color: red">{{$errors->first('password')}}</span></div>
                                                                                                                @endif

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
                                                                                                        </div>
                                                                                                        <select class="form-control form-select" name="poste" id="poste">
                                                                                                            <option value="" selected disabled hidden>veuillez selectionner un poste</option>
                                                                                                            <option value="vice president">vice president</option>
                                                                                                            <option value="Divisionnaire">manager</option>
                                                                                                            <option value="employé">employé</option>
                                                                                                            <option value="relai">relai</option>
                                                                                                            <option value="admin">admin</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    @if($errors->has('poste'))
                                                                                                        <div><span style="color: red">{{$errors->first('poste')}}</span></div>
                                                                                                                @endif

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                                                                                        </div>
                                                                                                        <select class="form-control form-select" name="division" id="division">
                                                                                                            @foreach ($dep as $d)
						
                                                                                                            <option value={{$d->nomdep}}  >{{$d->nomdep}}</option>
                                                                                                           
                                                        
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