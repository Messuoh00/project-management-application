@extends('layout.main')

@section('styles')
<link href="{{ asset('css/allprojects.css') }}" rel="stylesheet" type="text/css"  >

@endsection

@section('content')


@php
    $ur=Request::fullUrl();
  $ur=substr($ur,-3);
    
@endphp



<table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
  
   
    <p style="position: absolute;padding-top: 10px">ajouter projet : <a href="projet/create"><img src="{{url('/img/add.png')}}" height="35px"></a> </p>
  <thead>
    <tr style="text-align: center">
  
      <th scope="col" data-sortable="true">Nom Projet</th>
      <th scope="col" data-sortable="true">Structure Pilote</th>
      <th scope="col" data-sortable="true">Chef Projet </th>
   {{-- @if ($ur=='jet')    @endif  --}}
   <th scope="col" data-sortable="true">Phase</th>
      <th scope="col" data-width="1" data-width-unit="%"  data-searchable="false">options</th>


    </tr>
  </thead>
  <tbody>
   
    @foreach ($projects as $project)
   

    @if ( ($project->phase==$ur)||($ur=='jet') )
            
    
   
    <tr id={{$project->id}}>
     
      <th scope="row" style="text-align: center">  <a href="/projet/ {{$project->id}}"> {{$project->nom_projet}} </a> </th>
      <td style="text-align: center">{{$project->structure_pilote}}</td>
      <td style="text-align: center">{{$project->chef_projet}} </td>
      {{-- @if ($ur=='jet')   @endif  --}}
      <td style="text-align: center">{{$project->phase}} </td> 
      <td class="delete_edit"> 
        
        <a href="/projet/ {{$project->id}}/edit">
        <button type="button submit" class="btn" style="text-align: center">
          <img src="{{url('/img/edit.png')}}" height="20"  alt="">  
           </button>
          </a>
          <br>
           
        


      <form action="/projet/{{$project->id}}" method="POST">

        @csrf
        @method('delete')
        <button type="button submit" class="btn" style="text-align: center">
          <img src="{{url('/img/delete.png')}}" height="20"  alt="">  
           </button>
      </form>
        


      </td>
    </tr>


    @endif


    @endforeach

  </tbody>

</table>

  
 <div>
  
  <div style="position: absolute; right: 0px; padding-top:10px;">
   
   
    </div>
 </div>





@endsection


    
