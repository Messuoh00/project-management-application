@extends('layout.main')


@section('styles')


<link href="{{ asset('css/projectview.css') }}" rel="stylesheet" type="text/css"  >


@endsection





@section('content')



<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>



                            <form action='/{{$project->id}}/equipe' method="POST" enctype="multipart/form-data">
                                @csrf


                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Fichier de  L'equipe <a href="/projet/{{$project->id}}"> {{$project->id}} </a> </h1>


                                <a href="/{{$project->id}}/equipepub" class="d-none d-sm-inline-block btn btn-sm  btn-warning shadow-sm">
                                    <button type="button" class="btn   ">publication projet</button> <i class="fas fa-download fa-sm text-white-50"></i>
                                </a>


                            </div>



                                <!-- Content Row -->
                                <div class="row" style="margin-top: 40px">

                                    <!-- Pending Requests Card Example -->
                                    <div class="col">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                   <div class="col ">


                                                   <h5>ficher:</h5>
                                                   @php
                                                       $filename="fichier_equipe";

                                                           $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                           $files=array( );
                                                           if (file_exists($file_path)) { $files = \File::allFiles($file_path); }

                                                   @endphp

                                                   <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >

                                                       <thead>
                                                           <th></th>

                                                       </thead>

                                                       <tbody >

                                                           @foreach ($files as $pdffilename)
                                                           <tr >
                                                                   <td><b>{{pathinfo($pdffilename)['basename']}}</b>

                                                                  <div style="float: right">

                                                                    <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <button type="button" class="btn  btn-info  "><i class="fas fa-fw fa-download"></i> download</button></a>

                                                                     @if ($project->phase_id!=1)

                                                                       <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete </button></a>
                                                                       @endif
                                                                   </div>

                                                                   </td>

                                                           </tr>
                                                           @endforeach
                                                       </tbody>

                                                   </table>
                                                   <br>

                                                   @if ($project->phase_id!=1)
                                                   <input class="form-control form-control-sm" id="team"  name="team"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">
                                                   @endif


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>




                            <div  style="text-align: right; ">

                            <button type="submit" name="updateall" class="btn btn-warning" style="margin-top: 20px"> Appliquer</button>

                             </div>






                            </form>


@endsection

