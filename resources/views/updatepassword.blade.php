@extends('layout.main')


@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >



@endsection





@section('content')



                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">modification du mot de passe:</h1>
                           
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
                                                                            
                                                                            
                                                                                <form method="post" action="/passwordupdate/" >
                                                                                {{csrf_field()}}
                                                                                {{ method_field('PATCH') }}
                                                                                
                                                                                <h6  >ancien mot de passe:</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                    </div>
                                                                                    <input id="oldpassword" name="oldpassword" class="form-control" placeholder="ancien mot de passe " type="password">
                                                                                </div>
                                                                                   @if($errors->has('oldpassword'))
                                                                                <div><span style="color: red">veuillez introduire l'ancien mot de passe</span></div>
                                                                                        @endif
                                                                                <h6  > nouveau mot de passe:</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                                                                                    </div>

                                                                                    <input  id="newpassword" name="newpassword" class="form-control" placeholder="nouveau mot de passe " type="password">
                                                                                    
                                                                                </div>
                                                                                @if($errors->has('newpassword'))
                                                                                <div><span style="color: red">veuillez introduire le nouveau mot de passe</span></div>
                                                                                        @endif
                                                                                <h6  >confirmation du nouveau mot de passe :</h6>
                                                                                <div class="form-group input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
                                                                                    </div>

                                                                                    <input  id="newpassword2" name="newpassword2" class="form-control" placeholder="confirmation du nouveau mot de passe " type="password">
                                                                                    
                                                                                </div>
                                                                                @if($errors->has('newpassword2'))
                                                                                <div><span style="color: red">veuillez introduire la confirmation du nouveau mot de passe</span></div>
                                                                                        @endif

                                                                            



                                                                                
                                                                            
                                                                                

                                                                                    @if($message=Session::get('error'))
                                                                                    
                                                                                    
                                                                                        
                                                                                <div><span style="color: red">{{Session::get('error')}}</span></div>
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