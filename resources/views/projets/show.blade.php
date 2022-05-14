@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectview.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')


@php

$nomphase = array("Idee R/D Non Valider", "Idee R/D", "Maturation", "Recherche(En cours)",'Recherche(En TEST)','En implementation','En exploitation','');

@endphp


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">INFO PROJET N:{{$project->id}}</h1>

</div>

@if ($errors->any())
<div><h4 style="color: red">{!!implode('', $errors->all('<div>:message</div>')) !!}</h4></div>
@endif
<!-- Content Row -->
<div class="row">

  <!-- Pending Requests Card Example -->
  <div class="col">
      <div class="card shadow">
          <div class="card-body">
              <div class="row no-gutters align-items-center">
                  <div class="col x">


                    @php
                    $next= App\Models\Phase::get()->where('position','=',$project->phase->position+1)->first();

                    $vra= App\Models\Vra::latest()->get()->where('phase_id','=',$project->phase_id)->where('project_id','=',$project->id)->first();


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

                                                  <div class="row" >
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
                                                    {{$project->phase->name}}
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
                                              {{$project->departement->nomdep}}
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
                                                @if (!empty($chef))
                                              <a href="/users/{{$chef->id}}"><p>{{$chef->nom}} {{$chef->prenom}}</p></a>
                                                @endif
                                              </div>
                                              </div>


                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Representant E&P:</h6>
                                              </div>
                                              <div class="col-sm-9 ">
                                                @if (!empty($rep))
                                              <a href="/users/{{$rep->id}}"><p>{{$rep->nom}} {{$rep->prenom}}</p></a>
                                                @endif
                                              </div>
                                              </div>
                                              <hr>

                                              <div class="row">
                                              <div class="col-sm-3">
                                              <h6 class="mb-0">Equipe:</h6>
                                              </div>
                                              <div class="col-sm-9 "style="overflow-y: scroll; height:235px;" >
                                             @if (!empty($equipe))
                                             @foreach ($equipe as $eq)
                                                  <a href="/users/{{$eq->id}}"><p>{{$eq->nom}}  {{$eq->prenom}}</p></a>
                                              @endforeach
                                              @endif
                                              </div>
                                              </div>
                                              <hr>




                                              </div>



                                              </div>






                                              <div class="filebutt" style="text-align: center">
                                                <!-- Button trigger modal -->
                                                <div>
                                                <a href="/fichier/{{$project->id}}/{{$project->phase->name}}?var=show"> <button type="button" class="btn   btn-warning btn-lg " >
                                                    <i class="fas fa-fw fa-print"></i> fichier du projet
                                                </a>
                                                </div>

                                                <div>
                                                <a href="/{{$project->id}}/equipe"> <button type="button" class="btn   btn-warning btn-lg " >
                                                    <i class="fas fa-fw fa-book"></i> fichier equipe
                                                </a>
                                                </div>

                                                <div >
                                                <a href="/{{$project->id}}/hequipe"> <button type="button" class="btn   btn-warning btn-lg " >
                                                    <i class="fas fa-fw fa-user"></i> Historique equipe
                                                </a>
                                                </div>

                                              </div>



                                              <hr>

                                              <div class="card-body status">
                                              <h6 class="d-flex align-items-center mb-3"> Statut Projet:</h6>
                                              <small>Visibilite:{{$vra->visibilite}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width:{{$vra->visibilite}}%" aria-valuenow="{{$vra->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                              <small>Reactivite:{{$vra->reactivite}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: {{$vra->reactivite}}%" aria-valuenow="{{$vra->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                              <small>Avancement:{{$vra->avancement}}%</small>
                                              <div class="progress mb-3" style="height: 5px">
                                              <div class="progress-bar bg-primary" role="progressbar" style="width: {{$vra->avancement}}%" aria-valuenow="{{$vra->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>

                                              <div style="float: right">
                                                <a href="/stat/{{$project->id}}"> <button type="button" class="btn   btn-warning btn-lg " >
                                                    <i class="fas fa-fw  fa-archive"></i> Statistique Projet
                                                </a>
                                                </div>

                                              </div>



                                              <div class="card-body status gutters-sm ">
                                              <h6 class="d-flex align-items-center mb-3">Description:</h6>

                                              <div class="col-sm-9 box "style="overflow-y: scroll; height:200px;" >

                                              {{$project->description}}
                                              </div>


                                              </div>



















                                              <div class="editer">















                                              <div class="editerbtn" >



                                                @if (!empty($next))

                                              <button type="button" class="btn " data-toggle="modal" data-target="#exampleModal{{$project->id}}">
                                              <img src="{{url('/img/next.png')}}" height="20"  alt="">
                                              </button>



                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                              <div class="modal-header">


                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                  </button>


                                              </div>






                                              <div class="modal-body" style="text-align: center">
                                                <h4 style="color: black">Passer a la phase {{$next->name}} ?</h4>

                                              <div class="form-group radio" style="    text-align:center ; height:20%">
                                                <h6 class="mb-0" style="text-align: left; color:black" > Envoyer mail:</h6>

                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sendmail" id="sendmail2" value="0">
                                                    <label style="color: black"class="form-check-label" for="inlineRadio2">non</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="sendmail" id="sendmail1" value="1"  checked >
                                                    <label style="color: black"class="form-check-label" for="inlineRadio1">oui</label>
                                                    </div>

                                            </div>
                                              </div>



                                              <div class="modal-footer">



                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>





                                                  <form action="/projet/{{$project->id}}" method="POST">
                                                  @csrf
                                                  @method('PUT')


                                                  <input type="text" value="{{$project->phase->position}}" name="currentphase" hidden>
                                                  <button type="button submit" class="btn btn-warning" style="text-align: center">Confirme </button>

                                                  </form>




                                              </div>
                                              </div>
                                              </div>
                                              </div>


                                              @endif

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
                                                    <button type="button submit" class="btn btn-danger">supprime</button>
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

