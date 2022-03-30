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

@php
    $ur=Request::fullUrl();
    $url_components = parse_url($ur);
  
  // Use parse_str() function to parse the
  // string passed via URL
  parse_str($url_components['query'], $params);

  
    
@endphp





@section('content')

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>



                            <form action='/fichier/{{$project->id}}/{{$phase}}' method="POST" enctype="multipart/form-data">
                                @csrf       
    

                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Fichier du projet <a href="/projet/{{$project->id}}"> {{$project->id}} </a> </h1>
                                
                            </div>
               
                                                  
                                                        
                            @if ($project->phase >= 1.2)
                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                
      
                                                    <h5>fichier de la  Phase avant projet et planification::</h5>  
                                                    <br>                                              
                                                    <h6>fichier note:</h6>  
                                                    
                                                    @php
                                                    $filename="note";
                                            
                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                    $files=array( );
                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                
                                                    @endphp
                                                      
                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                           <thead>
                                                               <tr>
                                                                   <th></th>
                                                                  
                                                               </tr>
                                                           </thead>
                                                                
                                                        <tbody >

                                                            @foreach ($files as $pdffilename)
                                                            <tr >
                                                                    <td><b>{{pathinfo($pdffilename)['basename']}}</b>
                                                                 
                                                                   <div style="float: right">
                                                                        <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <button type="button" class="btn  btn-info  "><i class="fas fa-fw fa-download"></i> download</button></a>
                                                                        @if ( $params['var']=='edit')
                                                                        <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}/{{$phase}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete   </button></a>
                                                                        @endif
                                                                    </div>
                                                               
                                                                    </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                         
                                                    </table> 
                                                    @if ( $params['var']=='edit')
                                                    <br>
                                                    <input class="form-control form-control-sm" id="misc"  name="note"  type="file" accept= " application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                                                    <br>
                                                    <hr>
                                                    @endif
                                                    <h6>fichier fiche:</h6>  
                                                    
                                                    
                                                       @php
                                                                $filename="fiche";
                                                        
                                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                    $files=array( );
                                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                            
                                                      @endphp
        
                                                      
                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                               
                                                            </tr>
                                                        </thead>
                                                                
                                                        <tbody >

                                                            @foreach ($files as $pdffilename)
                                                            <tr >
                                                                    <td><b>{{pathinfo($pdffilename)['basename']}}</b>
                                                                     
                                                                    <div style="float: right">
                                                                    
                                                                        <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <button type="button" class="btn  btn-info  "><i class="fas fa-fw fa-download"></i> download</button></a>
                                                                        @if ( $params['var']=='edit')
                                                                        <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}/{{$phase}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete   </button></a>
                                                                         @endif
                                                                    </div>
                                                                    </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                         
                                                    </table> 
                                                    @if ( $params['var']=='edit')
                                                    <br>
                                                    <input class="form-control form-control-sm" id="fiche"  name="fiche"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">
                                                    <br><br>
                                                    @endif
                                                    
                                                  
 
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endif

                            @if ($project->phase >= 2.2)

                                <!-- Content Row -->
                                <div class="row" style="margin-top: 40px">

                                    <!-- Pending Requests Card Example -->
                                    <div class="col">
                                        <div class="card ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col ">
                                                    
      
                                                    <h5>fichier de la  Phase Execution et suivi evaluation:</h5>  
                                                    <br>
                                                    <h6>fichier misc:</h6>  
                                                    
                                                    @php
                                                    $filename="misc";
                                            
                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                    $files=array( );
                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                
                                                    @endphp
                                                      
                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                           
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                               
                                                            </tr>
                                                        </thead>

                                                        <tbody >



                                                            @foreach ($files as $pdffilename)
                                                            <tr >
                                                                    <td><b>{{pathinfo($pdffilename)['basename']}}</b>
                                                                      
                                                                    <div style="float: right">
                                                                        <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <button type="button" class="btn  btn-info  "><i class="fas fa-fw fa-download"></i> download</button></a>
                                                                        @if ( $params['var']=='edit')
                                                                        <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}/{{$phase}}"> <button type="button" class="btn   btn-danger"onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete   </button></a>
                                                                        @endif
                                                                    </div>
                                                                   
                                                                    </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                         
                                                    </table> 
                                                    @if ( $params['var']=='edit')
                                                    <br><br>
                                                    
                                                    <input  class="form-control form-control-sm" id="misc"  name="misc"  type="file" accept= " application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf">
                                                    @endif
                                                  
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                                
                                @endif
                            
    
                                <!-- Content Row -->
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
                                                                       @if ( $params['var']=='edit')
                                                                       <a href="/delete/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}/{{$project->id}}/{{$phase}}"> <button type="button" class="btn   btn-danger " onclick="return confirm('etes vous sur de vouloir supprimer ce fichierr?');"><i class="fas fa-fw fa-times"></i> delete </button></a>
                                                                       @endif
                                                                   </div>
                                                              
                                                                   </td>
                                                               
                                                           </tr>
                                                           @endforeach
                                                       </tbody>
                                                       
                                                   </table> 
                                                   <br>
                                               
                                               @if ( $params['var']=='edit')
                                                   <input class="form-control form-control-sm" id="random"  name="random"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">
                                                
                                                   @endif
                                                 
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>

                                
                            
                            @if ( $params['var']=='edit')
                            <div  style="text-align: right; ">

                            <button type="submit" name="updateall" class="btn btn-warning" style="margin-top: 20px"> Appliquer</button>

                             </div>

                             @endif
                            


                             
                            </form>



@endsection

