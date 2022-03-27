@extends('layout.main')


@section('styles')




@endsection


@section('content')
            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                   

                                                    @if(isset(Auth::user()->email))
                                                    <h1>   {{Auth::user()->id}}     </h1>  
                                                    <h1>   <a href="{{ url('/logout')}}"> se deconnecter </a>                   </h1>
                                                    <h1>   <a href="{{ url('/users')}}"> liste des utilisateurs </a>                   </h1>
                                                    <h1>   <a href="{{ url('/passwordedit')}}"> changer mot de passe </a>                   </h1>
                                                    @else 

                                                    <script> window.location="/login";      </script>
                                                    @endif


                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



@endsection