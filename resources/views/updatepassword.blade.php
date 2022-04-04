@extends('layout.main')


@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >



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
                                                   
                      
                                                                            <div class="container">
                                                                            <h3> modification du mot de passe:</h3>
                                                                            
                                                                                <hr>
                                                                            
                                                                            
                                                                                <form method="post" action="/passwordupdate/" >
                                                                                {{csrf_field()}}
                                                                                {{ method_field('PATCH') }}
                                                                                
                                                                                <h6  >veuillez introduire l'ancien mot de passe:</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                    </div>
                                                                                    <input id="oldpassword" name="oldpassword" class="form-control" placeholder="ancien mot de passe " type="password">
                                                                                </div>
                                                                                <h6  >veuillez introduire le nouveau mot de passe:</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                                                                                    </div>

                                                                                    <input  id="newpassword" name="newpassword" class="form-control" placeholder="nouveau mot de passe " type="password">
                                                                                    
                                                                                </div>
                                                                                <h6  >veuillez introduire une nouvelle fois le nouveau mot de passe :</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                                                                                    </div>

                                                                                    <input  id="newpassword2" name="newpassword2" class="form-control" placeholder="confirmation du nouveau mot de passe " type="password">
                                                                                    
                                                                                </div>

                                                                            



                                                                                
                                                                            
                                                                                

                                                                                    @if($message=Session::get('error'))
                                                                                    {{Session::get('error')}}
                                                                                        @endif
                                                                                        @if(count($errors) >0)

                                                                                        @foreach($errors->all() as $error)
                                                                                        {{$error}}
                                                                                        @endforeach

                                                                                        @endif
                                                                                        <button type="submit" class="btn btn-warning">Valider</button>
                                                                                </form> 
                                                                            </div>




                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





@endsection