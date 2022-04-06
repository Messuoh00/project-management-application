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
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="prenom" name="prenom" class="form-control" placeholder="prenom" type="text">
                                                                                                    </div>
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="email" name="email" class="form-control" placeholder="adresse email" type="email">
                                                                                                    </div>

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="password" name="password" class="form-control" placeholder="mot de passe " type="password">
                                                                                                    </div>

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
                                                                                                        </div>
                                                                                                        <select class="form-control form-select" name="poste" id="poste">
                                                                                                            <option value="" selected disabled hidden>veuillez selectionner un poste</option>
                                                                                                            <option value="vice president">vice president</option>
                                                                                                            <option value="manager">manager</option>
                                                                                                            <option value="employé">employé</option>
                                                                                                            <option value="admin">admin</option>
                                                                                                        </select>
                                                                                                    </div>

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                                                                                        </div>
                                                                                                        <select class="form-control form-select" name="division" id="division">
                                                                                                            <option value="" selected disabled hidden>veuillez selectionner une division</option>
                                                                                                            <option value="ep">ep</option>
                                                                                                            <option value="ped">ped</option>
                                                                                                            <option value="exp">exp</option>
                                                                                                            <option value="dp">dp</option>
                                                                                                            <option value="ast">ast</option>
                                                                                                            <option value="for">for</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                                @if(count($errors) >0)

                                                                                                            @foreach($errors->all() as $error)
                                                                                                            {{$error}}
                                                                                                            @endforeach

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