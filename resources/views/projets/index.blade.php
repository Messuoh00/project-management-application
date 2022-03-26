@extends('layout.main')

@section('styles')
 <link href="{{ asset('css/allprojects.css') }}" rel="stylesheet" type="text/css"  >

@endsection

@section('content')


@php
    $ur=Request::fullUrl();
  $ur=substr($ur,-3);
    
@endphp



<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">PROJET:</h1>

</div>

<!-- Content Row -->
<div class="row">

  <!-- Pending Requests Card Example -->
  <div class="col">
      <div class="card ">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col ">
                     
                                                                      
                      <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                      
                      
                          <p style="position: absolute;padding-top: 10px">ajouter projet : <a href="projet/create"><img src="{{url('/img/add.png')}}" height="35px"></a> </p>
                      <thead>
                          <tr style="text-align: center">
                      
                          <th scope="col" data-sortable="true">Nom Projet</th>
                          <th scope="col" data-sortable="true">Structure Pilote</th>
                          <th scope="col" data-sortable="true">Chef Projet </th>
                      @if ($ur=='jet')   <th scope="col" data-sortable="true">Phase</th>  @endif 
                      
                          <th scope="col" data-width="1" data-width-unit="%"  data-searchable="false">options</th>


                          </tr>
                      </thead>
                      <tbody>
                      
                      @foreach ($projects as $project)
                      
                      @php

                      switch ($project->phase) 
                      {
                          
                      case 1.1:
                      $phase1=1.2;   $phasenom1=' Maturation'; $phasenom='Idee R/D  ';

                      break;

                      case 1.2:
                      $phase1=2.1;   $phasenom1='Recherche(En cours)';$phasenom='Maturation ';
                      break;

                      case 2.1:
                      $phase1=2.2;   $phasenom1='Recherche(En TEST)';$phasenom='Recherche(En cours) ';
                      break;

                      case 2.2:
                      $phase1=3.1;   $phasenom1='Archivage ';$phasenom='Recherche(En TEST) ';

                      
                      break;

                      case 3.1:
                      $phase1=3.1;   $phasenom1='Archivage ';$phasenom='Archivage';

                      
                      break;
                      }

                      @endphp

                          @if ( ($project->phase==$ur)|| ( ($ur=='jet')&&($project->phase!=3.1) ) )
                                  
                      
                      
                          <tr id={{$project->id}}>
                          @php
                              
                          $namechef='';
                      
                              $x=$user->where('id',$project->chef_projet)->first();
                              if(!empty($x)) $namechef=$x->nom.' '.$x->prenom;
                          
                          @endphp
                      
                          <th scope="row" style="text-align: center">  <a href="/projet/ {{$project->id}}"> {{$project->nom_projet}} </a> </th>
                          <td style="text-align: center">{{$project->structure_pilote}}</td>
                          <td style="text-align: center"> <a href="/users/{{$project->chef_projet}}">{{$namechef}} </a> </td>
                          @if ($ur=='jet')  <td style="text-align: center">{{$phasenom}} </td>   @endif 
                          
                          <td class="delete_edit"> 
                              
                              <a href="/projet/ {{$project->id}}/edit">
                              <button type="button submit" class="btn" style="text-align: center">
                              <img src="{{url('/img/edit.png')}}" height="20"  alt="">  
                              </button>
                              </a>
                              <br>

                              @php 
                          switch ($project->phase) {

                              case '1.1':
                              $bol=true;
                              break;

                              case '1.2':
                              $bol=!empty(storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\note') );
                              $bol1=!empty(storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\fiche' ));
                              $bol=$bol and $bol1;
                              break;


                              case '2.1':
                              $bol=true;
                              break;


                              case '2.2':
                              $bol=!empty(storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\misc' ) );
                              break;
                              
                              case '3.0':
                              $bol=false;
                              break;
                              
                              default:
                              $bol=true;
                              break;

                          }
                          
                          @endphp    
                          
                          
                              @if (strcmp($phasenom,"Archivage"))
                              <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal{{$project->id}}">
                                  <img src="{{url('/img/next.png')}}" height="20"  alt="">  
                              </button>
                              @endif
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"> Passer a la phase {{$phasenom1}} ?</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      </div>
                                  
                                      @if (!$bol)
                                          
                                      <div class="modal-body">
                                      Passage impossible il manque des document !
                                      </div>
                                      @endif

                                      <div class="modal-footer">



                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                      


                                          @if($bol)
                                      
                                      <form action="/projet/{{$project->id}}" method="POST">
                                          @csrf
                                          @method('PUT')
                                              
                                      <input type="text" value="{{$phase1}}" name="updatephase" hidden>    
                                      <button type="button submit" class="btn btn-warning" style="text-align: center">Confirme </button>
                                  
                                      </form>

                                  
                                      @endif
                              
                                      </div>
                                  </div>
                                  </div>
                              </div>  


                              
                      
                              
                                  

                          
                      <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal{{$project->id}}supp">
                      <img src="{{url('/img/delete.png')}}" height="20"  alt=""> 
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$project->id}}supp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"> Supprimer le projet n:{{$project->id}}?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                              
                              <form action="/projet/{{$project->id}}" method="POST">
                              @csrf
                              @method('delete')
                              <button type="button submit" class="btn btn-danger" >supprime</button>
                              </form>

                          </div>
                          </div>
                      </div>
                      </div>  


                          </td>
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

  


@endsection


    
