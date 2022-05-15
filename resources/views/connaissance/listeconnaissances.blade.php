@extends('layout.main')


@section('styles')

   <link href="{{asset('css/publication.css')}}" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    

@endsection





@section('content')
<script>
    var slideIndex = {{json_encode($slides)}};
    function plusSlides(n,m) {
      showSlides(slideIndex[m] += n,m);
    }
    function showSlides(n,m) {
      var i=1;
      
      var slides = document.getElementsByClassName("mySlides"+m);
      if (n > slides.length) {slideIndex[m] = 1}    
      if (n < 1) {slideIndex[m] = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      slides[slideIndex[m]-1].style.display = "block";  
    }
    </script>



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
                                                                

        
                                                         @php
                                                            $i = 0;
                                                        @endphp
                                                        <div class="input-group">
                                                        <input type="search" id='recherche' class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                                        <button type="button" class="btn btn-outline-primary" onclick="search(event)">search</button>
                                                        </div>
                                                     
                                                        @foreach($connaissances as $connaissance)
                                                                    @php
                                                                    $nbr = 1;
                                                                    $imagevid=0;
                                                                    $frontfichiers=[];
                                                                    @endphp
                                                                  
                                                        <div class="container  pubcont">

                                                            <div class="publication">

                                                                <div classe="publication_header">
                                                                    <div class="info-user">
                                                                        <span class="icone">
                                                                        <i class="fa  fa-2x fa-user"></i> 
                                                                        </span>
                                                                    <i class="user"> <a href="connaissances/profil/{{$connaissance->user->id}}">{{$connaissance->user->nom}} {{$connaissance->user->prenom}} </a> </i>
                                                                    @if(Auth::user()->id==$connaissance->user->id)
                                                                    <a class='supp-public' href="/connaissances/supprimer/{{$connaissance->id}}" onclick="return confirm('etes vous sur de vouloir supprimer cette connaissance?');" >
                                                                    <i class=" iconex fa  fa-2x fa-times"></i> 

                                                                        </a>
                                                                         @endif
                                                                  </div>
                                                                    <h8> {{$connaissance->date_publication}}</h8>
                                                                        


                                                                    
                                                                </div>
                                                                <hr class="trait">
                                                                <div class="publication_contenu">
                                                                
                                                                    <p class="corps">
                                                                        {{$connaissance->commentaire}}
                                                                    </p> 
                                                                    <div class="slideshow-container">
                                                                         @php 
                                                                         
                                                                        $routefichier=storage_path('app/public/'.$connaissance->fichiers);
                                                                        $fichiers=[];
                                                                        if($connaissance->fichiers!=''){
                                                                        if (file_exists($routefichier)){$fichiers = \File::allFiles($routefichier);}}
                                                                        $nbrtotal=0;
                                                                        foreach($fichiers as $fichier){
                                                                        $ext=pathinfo($fichier, PATHINFO_EXTENSION);
                                                                        if($ext=='mp4'||$ext=='jpg'||$ext=='png'||$ext=='gif'||$ext=='jpeg'){
                                                                        $nbrtotal=$nbrtotal+1;}
                                                                         }
                                                                       
                                                                       
                                                                        @endphp  
                                                                    @forelse($fichiers as $fichier)
                                                                    @php
                                                                    $ext=pathinfo($fichier, PATHINFO_EXTENSION);
                                                                    

                                                                   
                                                                    @endphp
                                                                    @if($ext=='mp4')
                                                                    @php $imagevid = 1; @endphp
                                                                    <div class="mySlides{{$i}} fade">
                                                                        <div class="numbertext">{{$nbr}} /{{$nbrtotal}}</div>
                                                                        <video controls src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="width:100%"></video>
                                                                        
                                                                        <div class="text">Caption Text</div>
                                                                    </div>
                                                                    @php
                                                                    $nbr =$nbr+1;
                                                                    @endphp
                                                                    @elseif($ext=='jpg'||$ext=='png'||$ext=='gif'||$ext=='jpeg')
                                                                    @php $imagevid = 1; @endphp
                                                                    <!-- Full-width images with number and caption text -->
                                                                    <div class="mySlides{{$i}} fade">
                                                                        <div class="numbertext">{{$nbr}} /{{$nbrtotal}}</div>
                                                                        <img  src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="width:100%">
                                                                        
                                                                    </div>
                                                                    @php
                                                                    $nbr =$nbr+1;
                                                                    @endphp
                                                                    @else
                                                                    @php
                                                                    $frontfichiers[]=$fichier 
                                                                    @endphp
                                                                    @endif
                                                                    

                                                                                                                                    
                                                                                                
                                                                       
                                                                    

                                                                    
                                                                  
                                                                    @empty
                                                                    
                                                                    @endforelse
                                                                    @if($imagevid==1)
                                                                    <!-- Next and previous buttons -->
                                                                    <a class="prev" onclick="plusSlides(-1,{{json_encode($i)}})">&#10094;</a>
                                                                    <a class="next" onclick="plusSlides(1,{{json_encode($i)}})">&#10095;</a>
                                                                    <script>
                                                                        showSlides(1,{{json_encode($i)}});
                                                                    </script>
                                                                    @endif
                                                                    
                                                                    
                                                                    
                                                                     
                                                                    
                                                                    </div>
                                                                    @forelse($frontfichiers as $fichier)
                                                                    <a class="btn btnfich" href="/telecharger/{{$connaissance->fichiers}}/{{pathinfo($fichier)['basename']}}"  > 
                                                                        <span>
                                                                        <i class="fa fa-3x fa-file"></i>
                                                                        </span>
                                                                        
                                                                        {{explode('.',pathinfo($fichier)['basename'],2)[1]}} </a>


                                                                    @empty

                                                                    @endforelse
                                                                    <br>
                                                                   
                                                                    @php
                                                                    $i = $i+1;
                                                                    @endphp


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