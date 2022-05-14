@extends('layout.main')


@section('styles')




@endsection





@section('content')



<form action='/0/equipe' method="POST" enctype="multipart/form-data">
    @csrf


<!-- Page Heading -->


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Rapport  R/D </h1>

</div>



    <!-- Content Row -->
    <div class="row" style="margin-top: 40px">

        <!-- Pending Requests Card Example -->
        <div class="col">
            <div class="card ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                       <div class="col ">
                       @php
                           $filename="fichier_equipe";

                               $file_path=storage_path('app\rapport');
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

                                           <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/0/0"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete </button></a>

                                       </div>

                                       </td>

                               </tr>
                               @endforeach
                           </tbody>

                       </table>
                       <br>


                       <input class="form-control form-control-sm" id="rapp"  name="rapp"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">



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

