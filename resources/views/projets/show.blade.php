@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectview.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">INFO PROJET N:{{$project->id}}</h1>
 
</div>

<!-- Content Row -->
<div class="row">

  <!-- Pending Requests Card Example -->
  <div class="col">
      <div class="card ">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col x">
                     
                            
                      

                                              @php
                                              $phase1=$project->phase;

                                              $phasenom='';

                                              switch ($phase1) {
                                                  
                                              case 1.1:
                                              $phase1=1.2;   $phasenom1='Maturation'; $phasenom='Idee R/D  ';
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
                                              $phase1=3.1;   $phasenom1='Archivage';$phasenom='Archivage';


                                              break;


                                              }

                                              @endphp

                                              <div class="conten_project_view">
                                             

                                              <div class="info">
                                              
                                              
                                              <div class="card-body info1">
                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Nom Projet:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->nom_projet}}
                                                      </div>
                                                  </div>
                                                  <hr>
                                                  
                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Thematique:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->thematique}}
                                                      </div>
                                                  </div>
                                                  <hr>
                                                  
                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Region Test:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->region_test}}
                                                      </div>
                                                  </div>
                                                  <hr>

                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Region implementation:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->region_implementation}}
                                                      </div>
                                                  </div>
                                                  <hr>
                                                  
                                                  
                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Region Exploitation:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->region_exploitation}}
                                                      </div>
                                                  </div>
                                                  <hr>


                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Date Debut:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->date_deb}}
                                                      </div>
                                                  </div>
                                                  <hr>
                                                      
                                                  <div class="row">
                                                  <div class="col-sm-3">
                                                  <h6 class="mb-0">Date Fin:</h6>
                                                  </div>
                                                  <div class="col-sm-9 ">
                                                  {{$project->date_fin}}
                                                  </div>
                                                  </div>

                                                  <hr>
                                                  
                                                  

                                                  <div class="row">
                                                      <div class="col-sm-3">
                                                      <h6 class="mb-0">Etude Echo:</h6>
                                                      </div>
                                                      <div class="col-sm-9 ">
                                                      {{$project->etude_echo}}
                                                      </div>
                                                  </div>
                                                  <hr>

                                                  <div class="row">
                                                    <div class="col-sm-3">
                                                    <h6 class="mb-0">Phase:</h6>
                                                    </div>
                                                    <div class="col-sm-9 ">
                                                    {{$phasenom}}
                                                    </div>
                                                </div>
                                                <hr>

                                              </div>

                                              <div class="card-body info2">
                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Abreviation:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                              {{$project->abreviation}}
                                              </div>
                                              </div>
                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Structure Pilote:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                              {{$project->structure_pilote}}
                                              </div>
                                              </div>
                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">budget:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                              {{$project->budget}}
                                              </div>
                                              </div>
                                              <hr>


                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Chef Projet:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                              <a href="/users/{{$project->chef_projet}}"><p>{{$chef}}</p></a>
                                              </div>
                                              </div>


                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Representant E&P:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                              <a href="/users/{{$project->representant_EP}}"><p>{{$rep}}</p></a>
                                              </div>
                                              </div>
                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Equipe:</h6>
                                              </div>
                                              <div class="col-sm-9 "style="overflow-y: scroll; height:155px;" >
                                              @foreach ($equipe as $eq)
                                                  <a href="users/{{$eq->id}}"><p>{{$eq->nom}}  {{$eq->prenom}}</p></a>
                                              @endforeach
                                              </div>
                                              </div>
                                              <hr>





                                              <div class="son son1 " style="text-align: center">
                                              <!-- Button trigger modal -->
                                              <button type="button" class="btn   btn-warning btn-lg "  data-toggle="modal" data-target="#exampleModalCenter">
                                                <i class="fas fa-fw fa-archive"></i> fichier du projet  
                                              </div>
                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLongTitle">Fichier:</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">

                                                      <div class="col-sm-9 ">
                                                      
                                                      
                                                          @php
                                                                  $filenames = array("note", "fiche", "random");
                                                          @endphp


                                                              @foreach ($filenames as $filename)
                                                              

                                                              @php
                                                              

                                                              
                                                          
                                                                      $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                      $files=array( );
                                                                      if (file_exists($file_path))
                                                                      {
                                                                      $files = \File::allFiles($file_path);
                                                                      }
                                                  
                                                                  
                                                                  
                                                              @endphp

                                                              <h6>les fichier {{$filename}}:</h6>
                                                              
                                                              @foreach ($files as $pdffilename)
                                                          
                                                              <b>{{pathinfo($pdffilename)['basename']}}</b>

                                                              <div >
                                                              
                                                                  <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}">download</a>
                                                              
                                                              </div>

                                                              @endforeach
                                                              <br> 
                                                          @endforeach
                                                      
                                                      </div>
                                                  
                                                  

                                                  </div>
                                                  <div class="modal-footer">
                                                  
                                                      <button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
                                                  </div>
                                                  </div>
                                              </div>
                                              </div>
                                              {{-- FORM N2 START HERE  FOR PASSAGE --}}








                                              <hr>
                                              </div>






                                              </div>








                                              <div class="card-body status">
                                              <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"> Statu</i>Projet:</h6>
                                              <small>Visibilite:{{$project->visibilite}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width:{{$project->visibilite}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                              <small>Reactivite:{{$project->reactivite}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: {{$project->reactivite}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                              <small>Avancement:{{$project->avancement}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: {{$project->avancement}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>

                                              </div>
                                                  
                                              

                                              <div class="card-body status gutters-sm ">
                                              <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"> Description:</i></h6>

                                              <div class="col-sm-9 box "style="overflow-y: scroll; height:200px;" >

                                              {{$project->description}}
                                              </div>


                                              </div>



















                                              <div class="editer">



                                       











                                              <div class="editerbtn" >  
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
                                                  <h5 class="modal-title" id="exampleModalLabel" style="color:black">Passer a la phase {{$phasenom1}} ?</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>

                                              @if (!$bol)
                                                  
                                              <div class="modal-body">
                                              <span style="color: black">   Passage impossible il manque des document !</span>
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




                                              </div>




                                              <div class="editerbtn" >  

                                              <a href="/projet/ {{$project->id}}/edit"> <button type="button" class="btn "> <img src="{{url('/img/edit.png')}}" alt="">       </button>  </a>    

                                              </div>

                                              <div class="editerbtn"  >

                                                <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal{{$project->id}}supp">
                                                <img src="{{url('/img/delete.png')}}" height="20"  alt=""> 
                                                </button>
  
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$project->id}}supp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Supprimer le projet n:{{$project->id}}?</h5>
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
  
                                                </div>


                                              </div>



                                              </div>


                                       
                      
                  </div>
                  
              </div>
          </div>
      </div>
  </div>

</div>
@endsection


    
@section('java')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>

  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>


@endsection