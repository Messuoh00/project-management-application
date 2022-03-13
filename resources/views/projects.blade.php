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
        
        <a href="/projet/ {{$project->id}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-pen icon icon1" viewBox="0 0 16 16">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
        </svg></a>    
        <br>
        <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash icon icon2" viewBox="0 0 16 16">
          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg></a>   
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


    
