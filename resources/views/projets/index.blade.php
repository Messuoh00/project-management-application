@extends('layout.main')

@section('styles')
<link href="{{ asset('css/allprojects.css') }}" rel="stylesheet" type="text/css"  >

@endsection

@section('content')



<table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
  
   
    <p style="position: absolute;padding-top: 10px">ajouter projet : <a href="projet/create"><img src="{{url('/img/add.png')}}" height="35px"></a> </p>
  <thead>
    <tr style="text-align: center">
  
      <th scope="col" style="width: 10% " data-sortable="true">Nom Projet</th>
      <th scope="col" style="width: 60% "data-sortable="true">Structure Pilote</th>
      <th scope="col" style="width: 5%"data-sortable="true">description </th>
      
      <th scope="col" style="width: 20%">options</th>
    </tr>
  </thead>
  <tbody>
   
    @foreach ($projects as $project)
   
    <tr >
     
      <th scope="row" style="text-align: center" >   <a href="/projet/ {{$project->id}}"> {{$project->nom_projet}} </a> </th>
      <td style="padding: 25px" >{{$project->structure_pilote}}</td>
      <td >{{$project->description}} </td>
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
    
    @endforeach

  </tbody>

</table>

  
 <div>
  
  <div style="position: absolute; right: 0px; padding-top:10px;">
   
   
    </div>
 </div>





@endsection


    
