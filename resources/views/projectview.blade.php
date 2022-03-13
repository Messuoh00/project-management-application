@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectview.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')


<div class="conten_project_view">
  <div class="N1">
    <h1>INFO PROJET</h1>
  </div>

   
    <div class="info">
          
            
      <div class="card-body info1">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Nom Projet</h6>
                  </div>
                  <div class="col-sm-9 ">
                    {{$project->nom_projet}}
                  </div>
                </div>
                <hr>
                
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Thematique</h6>
                  </div>
                  <div class="col-sm-9 ">
                    {{$project->thematique}}
                  </div>
                </div>
                <hr>
                
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Region Test</h6>
                  </div>
                  <div class="col-sm-9 ">
                    {{$project->region_test}}
                  </div>
                </div>
                <hr>
                
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Date Debut</h6>
                  </div>
                  <div class="col-sm-9 ">
                    {{$project->date_deb}}
                  </div>
                </div>
                <hr>
                    
                <div class="row">
                <div class="col-sm-3">
                <h6 class="mb-0">Date Fin</h6>
                </div>
                <div class="col-sm-9 ">
                {{$project->date_fin}}
                </div>
                </div>

                <hr>
                
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Etude Echo</h6>
                  </div>
                  <div class="col-sm-9 ">
                    {{$project->etude_echo}}
                  </div>
                </div>
                <hr>
      </div>

      <div class="card-body info2">
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Abreviation</h6>
          </div>
          <div class="col-sm-9 ">
            {{$project->abreviation}}
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Structure Pilote</h6>
          </div>
          <div class="col-sm-9 ">
            {{$project->structure_pilote}}
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">budget</h6>
          </div>
          <div class="col-sm-9 ">
            {{$project->budget}}
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Chef Projet</h6>
          </div>
          <div class="col-sm-9 ">
            {{$project->chef_projet}}
          </div>
        </div>


        <hr>
        
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Representant E&P</h6>
          </div>
          <div class="col-sm-9 ">
            {{$project->representant_EP}}
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Equipe</h6>
          </div>
          <div class="col-sm-9 ">
            <a href="">List</a>
          </div>
        </div>
        <hr>
        
      </div>
      
    
    </div>

  
  
  
  
    <div class="card-body status">
        <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"> Statu</i>Projet:</h6>
        <small>Visibilite:{{$project->visibilite}}%</small>
        <div class="progress mb-3" style="height: 5px">
          <div class="progress-bar bg-primary" role="progressbar" style="width:{{$project->visibilite}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <small>Reactivite{{$project->reactivite}}%</small>
        <div class="progress mb-3" style="height: 5px">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{$project->reactivite}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <small>Avancement{{$project->avancement}}%</small>
        <div class="progress mb-3" style="height: 5px">
          <div class="progress-bar bg-primary" role="progressbar" style="width: {{$project->avancement}}%" aria-valuenow="{{$project->visibilite}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
       
    </div>
              
            
         
    <div class="card-body status gutters-sm ">
      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"> Description:</i></h6>
      <p class="box"> {{$project->description}}</p>
     
    </div>
  
  <div class="editer">
  
   

    <div class="editerbtn"  >
      <button type="button" class="btn ">
    <a href="" ><h3></h3> <img src="{{url('/img/delete.png')}}" height="20" alt=""></a>   
      </button>
    </div>

    <div class="editerbtn" >  
      <button type="button" class="btn ">
    <a href=""><h3></h3> <img src="{{url('/img/edit.png')}}" alt=""></a>    
      </button>
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