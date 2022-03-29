@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Fichier du projet <a href="/projet/{{$project->id}}"> {{$project->id}} </a> </h1>
                                
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                
                                                
                                                    <form action='/fichier/{{$project->id}}' method="POST" enctype="multipart/form-data">
                                                        @csrf                     
                                               
                                                     
                                                        @switch($project->phase)
                                                
                                                        
                                            
                                                
                                                        @case(1.1)
                                                            <span>Aucun fichier a ajouter dans la phase {{$phasenom}}</span>
                                                        @break
                                                        
                                                        @case(1.2)
                                                        <label class="form-label">note</label>
                                                       
        
                                                        
                                                                @php
                                                                    $filename="note";
                                                            
                                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                    $files=array( );
                                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                                
                                                                @endphp
                                        
                                                            <h6>les fichier {{$filename}}:</h6>
                                                            
                                                            @foreach ($files as $pdffilename)
                                                            <b>{{pathinfo($pdffilename)['basename']}} </b>  <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}">downlaod</a>  
                                                            @endforeach

                                                            <input class="form-control form-control-sm" id="misc"  name="note"  type="file" accept= " application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                                                        
        
                                                        <br>
                                                        <label  class="form-label">fiche projet</label>
                                                        
                                                                @php
                                                                $filename="fiche";
                                                        
                                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                    $files=array( );
                                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                            
                                                                @endphp
        
                                                                <h6>les fichier {{$filename}}:</h6>
                                                                
                                                                @foreach ($files as $pdffilename)
                                                                <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <b>{{pathinfo($pdffilename)['basename']}} </b></a>
                                                                   
                                                                @endforeach
                                                                <input class="form-control form-control-sm" id="fiche"  name="fiche"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">
        
                                                            @break 

                                                            
                                                            
                                                        @case(2.1)
                                                        <span>Aucun fichier a ajouter dans la phase {{$phasenom}}</span>
                                                            
                                                            @break 
                                                            
                                                        @case(2.2)
                                                        <label class="form-label">misc</label>
                                                      
        
                                                                @php
                                                                $filename="misc";
                                                        
                                                                    $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                    $files=array( );
                                                                    if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                                        
                                                                    @endphp
        
                                                                    <h6>les fichier {{$filename}}:</h6>
                                                                    
                                                                    @foreach ($files as $pdffilename)
                                                                    <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> <b>{{pathinfo($pdffilename)['basename']}} </b></a> 
                                                                        
                                                                    @endforeach
                                                                    <input  class="form-control form-control-sm" id="misc"  name="misc"  type="file" accept= " application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf">
                                                    
        
                                                            @break 
        
        
                                                            
                                                        @case(3.1)
                                                    
                                                        
                                                    
                                                            @break
        
                                                            @default
                                                    
                                                            
                                                    @endswitch
                                                    <hr>
                                                    <label  class="form-label">ajouter d'autre ficher </label>
                                                                           @php
                                                                            $filename="random";
                                                                    
                                                                                $file_path=storage_path('app\fichier-projet\fichier-projet-'.$project->id.'\\'.$filename);
                                                                                $files=array( );
                                                                                if (file_exists($file_path)) { $files = \File::allFiles($file_path); }
                                                            
                                                                        @endphp
        
                                                                        <h6>les fichier {{$filename}}:</h6>
                                                                        
                                                                        @foreach ($files as $pdffilename)
                                                                        <b>{{pathinfo($pdffilename)['basename']}} </b>

                                                                        <div style="float: right">
                                                                        
                                                                            <a href="/download/{{$file_path}}/{{pathinfo($pdffilename)['basename']}}"> download</a>

                                                                            


                                                                        </div>

                                                                         @endforeach
                                                               
                                                                         <input class="form-control form-control-sm" id="random"  name="random"  type="file" accept= "application/vnd.ms-excel, application/vnd.ms-powerpoint,application/pdf">
                                                     
                                                    <div  style="text-align: right; ">

                                                    <button type="submit" name="updateall" class="btn btn-warning" style="margin-top: 20px"> Appliquer</button>

                                                     </div>

                                                    </form>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





@endsection

