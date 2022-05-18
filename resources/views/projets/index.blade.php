@extends('layout.main')

@section('styles')
 <link href="{{ asset('css/allprojects.css') }}" rel="stylesheet" type="text/css"  >

@endsection

@section('content')



@php

  $ur=request()->input('phase');

@endphp



<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">PROJET:</h1>

</div>

<!-- Content Row -->
<div class="row">

  <!-- Pending Requests Card Example -->
  <div class="col">
      <div class="card shadow">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col ">


                      <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true" style="width:100%" >



                      <thead>
                          <tr style="text-align: center">

                          <th scope="col" data-sortable="true">Nom Projet</th>
                          <th scope="col" data-sortable="true">Structure Pilote</th>
                          <th scope="col" data-sortable="true">Thematique </th>
                          @if (!request()->has('phase'))   <th scope="col" data-sortable="true">Phase</th>  @endif




                          </tr>
                      </thead>
                      <tbody>

                      @foreach ($projects as $project)



                          @if (  (($project->phase->position==$ur)||( ($ur==null) )) )


                          <tr id={{$project->id}} style='height:100px;cursor: pointer; cursor: hand;'   >



                          <th scope="row" style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/projet/{{$project->id}}')">  {{$project->nom_projet}} </div> </th>

                          <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/projet/{{$project->id}}')">  {{$project->departement->nomdep}} </div> </td>

                          <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/projet/{{$project->id}}')"> {{$project->thematique}} </div> </td>

                          @if (!request()->has('phase'))
                          <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/projet/{{$project->id}}')">{{$project->phase->name}} </div> </td>
                          @endif



                          </tr>


                          @endif


                          @endforeach

                      </tbody>

                      </table>

                  </div>

              </div>
          </div>
      </div>
  </div>

</div>


<script type="text/javascript">
 function link(id)
            {
                location.href = id;
            }
   ;
</script>

@endsection



