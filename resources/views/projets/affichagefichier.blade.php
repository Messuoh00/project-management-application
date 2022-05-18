@extends('layout.main')


@section('styles')
<style>.btnSubmit
{
    border:none;
    border-radius:1.5rem;

    height: 40px;
    cursor: pointer;
    background: orange;
    color: #fff;

}
</style>

@endsection


@section('content')

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

@php
$ph = App\Models\Phase::orderBy('position')->get()->whereNotNull('position');
@endphp

                            <form action='/fichier/{{$project->id}}' method="POST" enctype="multipart/form-data">
                                @csrf


                            <!-- Page Heading -->



                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Fichier du projet <a href="/projet/{{$project->id}}"> {{$project->id}} </a> </h1>

                            </div>




                            @foreach ($ph as $p)

                            @if (($p->position <= $project->phase->position) || ( $project->phase_id==1)  )


                                <!-- Content Row -->
                                <div class="row" style="margin-top: 40px">

                                    <!-- Pending Requests Card Example -->
                                    <div class="col">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                   <div class="col ">


                                                   <h5>ficher de la phase {{$p->name}}:</h5>
                                                   @php
                                                       $filename=$p->id;

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
                                                                       @if (request()->input('var')=='edit')
                                                                       <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete </button></a>
                                                                       @endif
                                                                   </div>

                                                                   </td>

                                                           </tr>
                                                           @endforeach
                                                       </tbody>

                                                   </table>
                                                   <br>

                                               @if (request()->input('var')=='edit')
                                                   <input class="form-control form-control-sm" id="{{$p->id}}"  name="{{$p->id}}"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">

                                                   @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                @endif
                                @endforeach



                                <div class="row" style="margin-top: 40px">

                                    <!-- Pending Requests Card Example -->
                                    <div class="col">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                   <div class="col ">


                                                   <h5>autre ficher:</h5>
                                                   @php
                                                       $filename="random";

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
                                                                       @if (request()->input('var')=='edit')
                                                                       <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete </button></a>
                                                                       @endif
                                                                   </div>

                                                                   </td>

                                                           </tr>
                                                           @endforeach
                                                       </tbody>

                                                   </table>
                                                   <br>

                                               @if (request()->input('var')=='edit')

                                                   <input class="form-control form-control-sm" id="random"  name="random"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">

                                                @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            @if (request()->input('var')=='edit')
                            <div  style="text-align: right; ">

                            <button type="submit" name="updateall" class="btn btn-warning" style="margin-top: 20px"> Appliquer</button>

                             </div>

                             @endif




                            </form>



@endsection

