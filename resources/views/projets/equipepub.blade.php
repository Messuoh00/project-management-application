@extends('layout.main')


@section('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="{{ asset('css/formulairepub.css') }}" rel="stylesheet" type="text/css"  >

<link href="{{asset('css/publication.css')}}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


@endsection



@section('content')




<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Publication  de  L'equipe  </h1>


    <a href="/{{Request::segment(1)}}/equipe" class="d-none d-sm-inline-block btn btn-sm  btn-warning shadow-sm">
        <button type="button" class="btn ">fichier projet (equipe)</button> <i class="fas fa-download fa-sm text-white-50"></i>
    </a>


</div>


                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center" >
                                                <div class="col ">




                                                <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px;float:right;">
                                                    Ajouter publication projet
                                                </a>

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
                                                                    {{$publication->commentaire}}
                                                                </p>
                                                                <div class="slideshow-container">
                                                                     @php

                                                                    $routefichier=storage_path('app/'.$publication->fichiers);
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









            {{-- model creation publication --}}

            <div class="modal" tabindex="-1" role="dialog" id="myModal3">
                <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">publication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                                {{-- begin creation --}}
                                <div class="pere" id="pere" >
                                    <form method="post" action="{{url('/'.Request::segment(1).'/publicationequipe')}}" enctype="multipart/form-data"  >
                                        {{csrf_field()}}


                                    <label>text de la publication(non obligatoire):</label>
                                    <textarea class=" text-corps form-control" rows="5" name="commentaire"></textarea>
                                <div id="upload">

                                        <input id='id'type="text" value="{{Request::segment(1)}}" name='id' hidden>

                                        <input id='input1'type="file" name='fichiers[]'>
                                        <span class="text"> veuillez inserer un fichier:</span>
                                        <hr class="stylehr">

                                        <div id="iconupload"><i class="fa fa-download" aria-hidden="true"></i></div>

                                        <span id="file-upload-btn" class="btn btn-warning">selectionner un fichier</span>
                                        <hr class="stylehr">

                                    </div>
                                    @if($errors->has('fichiers'))
                                            <div><span style="color: red">veuillez au moin inserer un fichier</span></div>
                                            @endif
                                </div>

                                {{-- fin creation --}}
                    </div>

                     <div class="modal-footer">

                    <input id='publierbtn' type="submit" class="btn btn-warning" value='publier' >
                            </form>
                    </div>
                </div>
                </div>
            </div>





        <script>
            var fichiers=[]
            var input1=document.getElementById('input1');
            var btn=document.getElementById('file-upload-btn');
            var upload=document.getElementById('upload');


            btn.onclick=function(){input1.click();}
            input1.onchange=({target})=>{
                const file=target.files[0];

                if(file.name.split('.').pop().toLowerCase()=='jpg'||file.name.split('.').pop().toLowerCase()=='jpeg'||file.name.split('.').pop().toLowerCase()=='gif'||file.name.split('.').pop().toLowerCase()=='png'||file.name.split('.').pop().toLowerCase()=='mp4'){
                    alert("ce type de fichier n'est pas accepté ")
                    input1.value='';
                    for(i=0;i<fichiers.length;i++){
                        newfile = new File([fichiers[i]],fichiers[i].name);
                        list.items.add(newfile);

                }
                    input1.files=list.files;

                }else{


                if(file){
                    fichiers.push(file);
                    var filename=file.name;


                    if(filename.length>12){
                        filename=filename.substr(0,12)+'...'+filename.split('.').pop();
                    }
                    var template=document.createElement('template');
                    template.innerHTML=`
                    <div id="fichiers-selec" data-fich=${file.name}>
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



                }}


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
                    console.log(input1.files)

            }

        </script>




@endsection

