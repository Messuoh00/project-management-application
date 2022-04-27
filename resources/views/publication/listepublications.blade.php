@extends('layout.main')


@section('styles')

   <link href="{{asset('css/publication.css')}}" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    

@endsection





@section('content')



                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                                
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col ">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                                

        
                                                        
                                                        <div class="input-group">
                                                        <input type="search" id='recherche' class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                                        <button type="button" class="btn btn-outline-primary" onclick="search(event)">search</button>
                                                        </div>
                                                     
                                                        @foreach($publications as $publication)
                                                                  
                                                        <div class="container  pubcont">

                                                            <div class="publication">

                                                                <div classe="publication_header">
                                                                    <div class="info-user">
                                                                        <span class="icone">
                                                                        <i class="fa  fa-2x fa-user"></i> 
                                                                        </span>
                                                                    <i class="user"> <a href="publications/profil/{{$publication->user->id}}">{{$publication->user->nom}} {{$publication->user->prenom}} </a> </i>
                                                                    @if(Auth::user()->id==$publication->user->id)
                                                                    <a class='supp-public' href="/publications/supprimer/{{$publication->id}}" onclick="return confirm('etes vous sur de vouloir supprimer cette publication?');" >
                                                                    <i class=" iconex fa  fa-2x fa-times"></i> 

                                                                        </a>
                                                                         @endif
                                                                  </div>
                                                                    <h8> {{$publication->date_publication}}</h8>
                                                                        


                                                                    
                                                                </div>
                                                                <hr class="trait">
                                                                <div class="publication_contenu">
                                                                
                                                                    <p class="corps">
                                                                        {{$publication->corps}}
                                                                    </p> 
                                                                    <div class="slideshow-container">
                                                                         @php 
                                                                         
                                                                        $routefichier=storage_path('app\public/'.$publication->fichiers);
                                                                        $fichiers=[];
                                                                        if($publication->fichiers!=''){
                                                                        if (file_exists($routefichier)){$fichiers = \File::allFiles($routefichier);}}
                                                                       
                                                                        @endphp  
                                                                    @forelse($fichiers as $fichier)
                                                                                                                                    
                                                                                                    
                                                                        <a class="btn btnfich" href="/telecharger/{{$publication->fichiers}}/{{pathinfo($fichier)['basename']}}"  > 
                                                                        <span>
                                                                        <i class="fa fa-3x fa-file"></i>
                                                                        </span>
                                                                        
                                                                        {{explode('.',pathinfo($fichier)['basename'],2)[1]}} </a>
                                                                    

                                                                    
                                                                  
                                                                    @empty
                                                                    
                                                                    @endforelse
                                                                     
                                                                    
                                                                    </div>
                                                                    <br>
                                                                   
                                                                    


                                                                </div>
                                                                <hr class="trait">
                                                                
                                                                    

                                                                
                                                                
                                                                

                                                            </div>



                                                            </div>
                                                            




                                                       
                                                        @endforeach
                                                        
                                                        
                                                        



                                                               
                                                </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    



                                <script>

function search(event){
event.preventDefault();
chaine=document.getElementById('recherche').value;


listpublications=document.getElementsByClassName('pubcont');


for(i=0;i<listpublications.length;i++){
user=listpublications[i].getElementsByClassName('user');
corps=listpublications[i].getElementsByClassName('corps');


if(user[0].innerHTML.search(chaine)<0 && corps[0].innerHTML.search(chaine)<0){
    
    listpublications[i].style.display="none";
    
}else{
    listpublications[i].style.display="";
}


}}

    
</script>


@endsection