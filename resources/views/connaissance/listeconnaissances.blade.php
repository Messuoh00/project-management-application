@extends('layout.main')


@section('styles')

   <link href="{{asset('css/publication.css')}}" rel="stylesheet">
   <link href="{{asset('css/modalimage.css')}}" rel="stylesheet">
   <link href="{{ asset('css/formulairepub.css') }}" rel="stylesheet" type="text/css"  >

    
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

    btncon=document.getElementById("conlinknav");
    btncon.classList.add("pubconlinkactive");
    </script>



                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            @if (!isset($profil))
                                <h1 class="h3 mb-0 text-gray-800">Liste des connaissances</h1>
                                @else
                                <h1 class="h3 mb-0 text-gray-800">Liste des connaissances de {{$profil[0]}} {{$profil[1]}}</h1>
                                @endif
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col ">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                @if (!isset($profil))
                                                <div style=" margin-bottom:10px; display:flex; align-items:center; justify-content:center">
                                                    <a  id="btnajoutecon" class="btn btn-warning" style="border-radius:50px;padding:15px;" data-toggle="modal" href="#myModal3" > ajouter une connaissance</a>
                                                    </div>

                                                    {{-- model creation publication --}}

<div class="modal" tabindex="-1" role="dialog" id="myModal3">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"> création d'une connaissance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <div class="modal-body">
        <div class="pere" id="pere">
                                                    <form method="post" action="{{url('/connaissances')}}" enctype="multipart/form-data"  >
                                                        {{csrf_field()}}
                                                        <label > Titre:</label>
                                                        <input type="text" class="form-control" name="titre" >
                                                        @if($errors->has('titre'))
                                                             <div><span style="color: red">{{$errors->first('titre')}}</span></div>
                                                        @endif
                                                        <label > Discipline:</label>
                                                        <input type="text" class="form-control" name="discipline" >
                                                        @if($errors->has('discipline'))
                                                             <div><span style="color: red">{{$errors->first('discipline')}}</span></div>
                                                        @endif
                                                      
                                                        
                                                        <label  >corps:</label>
                                                        <textarea class=" text-corps form-control" rows="5" name="corps"></textarea>
                                                        @if($errors->has('corps'))
                                                             <div><span style="color: red">{{$errors->first('corps')}}</span></div>
                                                        @endif
                                                       <div id="upload">
            
                                                            <input id='input1'type="file" name='fichiers[]'>
                                                            <span class="text_form"> veuillez inserer un fichier:</span>
                                                            <hr class="stylehr">

                                                            <div id="iconupload"><i class="fa fa-download" aria-hidden="true"></i></div>

                                                            
                                                            
                                                            <span id="file-upload-btn" class="btn btn-warning">selectionner un fichier</span>
                                                            <hr class="stylehr">
                                                                   
                                                                                    
                                                            
                                                            
                                                          </div>
                                                          @if($errors->has('fichiers'))
                                                                <div><span style="color: red">veuillez au moin inserer un fichier</span></div>
                                                                @endif
                                                        <div id='divpublierbtn'> 
                                                        <input id='publierbtn' type="submit" class="btn btn-warning" value='publier'>


                                                        </div>

                                                        
                                                      
                                                      </form>
                                                    
                                            
                                                    
                                                        
                                                        </div>
                    
                       
        </div>

         <div class="modal-footer">

        
        </div>
    </div>
    </div>
</div>
@endif
                                                    
                                                                

        
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
                                                                    <i class="user"> <a href="/connaissances/profil/{{$connaissance->user->id}}">{{$connaissance->user->nom}} {{$connaissance->user->prenom}} </a> </i>
                                                                    @if(Auth::user()->id==$connaissance->user->id)
                                                                    <form action="/connaissances/{{$connaissance->id}}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                    <a class='supp-public' href="javascript:{}" onclick="supprimerconpub()" >
                                                                    <i class=" iconex fa  fa-2x fa-times"></i> 

                                                                        </a>
                                                                    </form>
                                                                         @endif
                                                                  </div>
                                                                    <h8> {{$connaissance->date_publication}}</h8>
                                                                        


                                                                    <h6 class="discipline"> discipline:{{$connaissance->discipline}}</h6>
                                                                </div>
                                                                <hr class="trait">
                                                                <div class="publication_contenu">
                                                                    <h5 class="titre" style="text-align:center;"> {{$connaissance->titre}}</h5>
                                                                
                                                                    <p class="corps">
                                                                        {{$connaissance->corps}}
                                                                    </p> 
                                                                    
                                                                    <div class="slideshow-container">
                                                                         @php 
                                                                         
                                                                        $routefichier=storage_path('app/public/'.$connaissance->fichiers);
                                                                        $fichiers=[];
                                                                        if($connaissance->fichiers!=''){
                                                                        if (file_exists($routefichier)){$fichiers = \File::allFiles($routefichier);}}
                                                                        $nbrtotal=0;
                                                                        foreach($fichiers as $fichier){
                                                                        $ext=strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
                                                                        if($ext=='mp4'||$ext=='jpg'||$ext=='png'||$ext=='gif'||$ext=='jpeg'){
                                                                        $nbrtotal=$nbrtotal+1;}
                                                                         }
                                                                       
                                                                       
                                                                        @endphp  
                                                                    @forelse($fichiers as $fichier)
                                                                    @php
                                                                    $ext=strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
                                                                    

                                                                   
                                                                    @endphp
                                                                    @if($ext=='mp4')
                                                                    @php $imagevid = 1; @endphp
                                                                    <div class="mySlides{{$i}} fade">
                                                                        <div class="numbertext">{{$nbr}} /{{$nbrtotal}}</div>
                                                                        <video onclick="demarragevideo(this,'modal{{$i}}_{{$nbr}}')" controls src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="cursor:pointer;width:100%"></video>
                                                                        
                                                                        
                                                                    </div>
                                                                    <div id="modal{{$i}}_{{$nbr}}" class="w3-modal" >
                                                                    <span onclick="fermermodvideo(this)" class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                                                                    <div class="w3-modal-content w3-animate-zoom">
                                                                    <video  controls  onclick="this.play()"src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="width:100%;margin-bottom:20px;"> </video>
                                                                    </div>
                                                                </div>
                                                                    @php
                                                                    $nbr =$nbr+1;
                                                                    @endphp
                                                                    @elseif($ext=='jpg'||$ext=='png'||$ext=='gif'||$ext=='jpeg')
                                                                    @php $imagevid = 1; @endphp
                                                                    
                                                                    <div class="mySlides{{$i}} fade">
                                                                        <div class="numbertext">{{$nbr}} /{{$nbrtotal}}</div>
                                                                        <img  onclick="demarrageimage(this,'modal{{$i}}_{{$nbr}}')" src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="cursor:pointer;width:100%">
                                                                        
                                                                    </div>
                                                                    <div id="modal{{$i}}_{{$nbr}}" class="w3-modal">
                                                                    <span  onclick="fermermod(this)"class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                                                                    <div class="w3-modal-content w3-animate-zoom">
                                                                    <img  src="{{asset('storage/'.$connaissance->fichiers.'/'.pathinfo($fichier)['basename'])}}" style="width:100%;margin-bottom:20px;">
                                                                    </div>
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
                                      function supprimerconpub(){
                                        if(confirm('etes vous sur de vouloir supprimer cette connaissance?')){
                                       parent=event.target.parentNode;
                                       if(parent.tagName.toUpperCase()=='A'){
                                        parent=parent.parentNode;
                                       }
                                       

                                       parent.submit();}
                                    }
                        var fichiers=[]
                    var input1=document.getElementById('input1');
                    var btn=document.getElementById('file-upload-btn');
                    var upload=document.getElementById('upload');
                    
                    
                    btn.onclick=function(){input1.click();}
                    input1.onchange=({target})=>{
                        const file=target.files[0];
                        fichiers.push(file);
                        
                    
                        
                        if(file){
                            var filename=file.name;
                            
                            
                            if(filename.length>12){
                              filename=filename.substr(0,12)+'...'+filename.split('.').pop();
                            }
                            var template=document.createElement('template');
                            
                            template.innerHTML=`
                            <div id="fichiers-selec" data-fich="${file.name}">
                            <i class=" iconefiche fa fa-file" aria-hidden="true"></i>
                            <span class='filename'> ${filename}</span>
                            <i class=" iconetimes fa fa-times" onclick="supprimer(this)" aria-hidden="true"></i> </div>`;
                            upload.appendChild(template.content);
                            
                            list = new DataTransfer();
                            
                            for(i=0;i<fichiers.length;i++){
                                newfile = new File([fichiers[i]],fichiers[i].name);
                                list.items.add(newfile);
                          
                        }
                            input1.files=list.files;
                            


                        }


                    }
                    function supprimer(elem){

                        pere=elem.parentNode;
                        filename=pere.getAttribute('data-fich');
                        
                        for(i=0;i<fichiers.length;i++){
                          
                            if(fichiers[i].name==filename){
                              
                                fichiers.splice(i,1);
                                break;
                            }
                        }
                        pere.remove();
                        list = new DataTransfer();
                            
                            for(i=0;i<fichiers.length;i++){
                                newfile = new File([fichiers[i]],fichiers[i].name);
                                list.items.add(newfile);
                          
                        }
                       
                            input1.files=list.files;
                            

                    }
        
        

        </script>


                                <script>
                                  

function search(event){
event.preventDefault();
chaine=document.getElementById('recherche').value;


listpublications=document.getElementsByClassName('pubcont');


for(i=0;i<listpublications.length;i++){
user=listpublications[i].getElementsByClassName('user');
corps=listpublications[i].getElementsByClassName('corps');
discipline=listpublications[i].getElementsByClassName('discipline');
titre=listpublications[i].getElementsByClassName('titre');


if(user[0].innerHTML.search(chaine)<0 && corps[0].innerHTML.search(chaine)<0 && titre[0].innerHTML.search(chaine)<0 && discipline[0].innerHTML.search(chaine)<0){
    
    listpublications[i].style.display="none";
    
}else{
    listpublications[i].style.display="";
}


}}
body=document.getElementsByTagName('body');
html=document.getElementsByTagName('html');
console.log(html);
    function demarragevideo(caller,id){
        caller.play();
        document.getElementById(id).style.display='block';
       
        html[0].style.overflow='hidden';
    }
    function demarrageimage(caller,id){
        console.log("bkr");
        
        document.getElementById(id).style.display='block';
       
        html[0].style.overflow='hidden';
    }
    function fermermod(caller){
      
        caller.parentElement.style.display='none';
        html[0].style.overflow='auto';
    }
    function fermermodvideo(caller){
      
      caller.parentElement.style.display='none';
      video=caller.parentElement.getElementsByTagName('video');
      
video[0].pause();
html[0].style.overflow='auto';

  }
    
</script>


@endsection