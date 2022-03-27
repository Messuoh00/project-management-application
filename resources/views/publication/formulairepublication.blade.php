@extends('layout.main')


@section('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


@endsection





@section('content')




                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Ajouter une Publication</h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                


                                                    <div class="pere" id="pere">
                                                    <form method="post" action="{{url('/publications')}}" enctype="multipart/form-data"  >
                                                        {{csrf_field()}}
                                                      
                                                        <label  >veuillez introduire le titre de la publication:</label>
                                                        <input type="text" id='titre' name='titre'>
                                                        <label  >corps:</label>
                                                        <textarea class="form-control" rows="5" name="corps"></textarea>
                                                        <div class="formfile" id="formfile">
                                                    
                                                        
                                                        <label  >fichier:</label>
                                                        <input type="file"   name="fichiers[]" id=input0 class="inputimgvid" accept="image/*,video/mp4" onchange="verification_image_video(this.id)"  >
                                                        </div>
                                                        <div>
                                                    
                                                        <a href="" name="add" id="add"> add</a>
                                                        <a href="" name="remove" id="remove"> remove </a>
                                                    
                                                      
                                                        
                                                        <input class="btn btn-dark" type="submit" value="publier">
                                                        </form>
                                                      
                                                    
                                                    
                                                        </div>
                                                        
                                                        <button class="btn btn-dark" id="upload_img_vid" disabled> upload  image/video</button>
                                                        <button class="btn btn-dark" id="upload_fichier"> upload fichier </button>
                                                    
                                                    
                                                    
                                                    
                                                        
                                                        </div>
                                                      
                                                    
                                                    
                                                        <script>
                                                    var i=1;
                                                    var formfile = document.getElementById('formfile');
                                                    var add_more_fields = document.getElementById('add');
                                                    var remove_fields = document.getElementById('remove');
                                                    var upload_img_vid=document.getElementById('upload_img_vid');
                                                    var upload_fichier=document.getElementById('upload_fichier');
                                                    
                                                    add_more_fields.onclick = function(event){
                                                        event.preventDefault();
                                                        var input_tags = formfile.getElementsByTagName('input');
                                                        var cloned=input_tags[0].cloneNode(true);
                                                        var newinput=document.createElement('input');
                                                        newinput.type='file';
                                                        newinput.name='fichiers[]';
                                                        newinput.className=cloned.className;
                                                        newinput.id='input'+i;
                                                        i=i+1;
                                                        if(newinput.className=='inputfichier'){
                                                          newinput.addEventListener("change",function(){verification_fichier(this.id)});
                                                        }else{  newinput.addEventListener("change",function(){verification_image_video(this.id)});}
                                                        newinput.accept=cloned.accept;
                                                        
                                                        
                                                      
                                                      formfile.appendChild(newinput);
                                                    }
                                                    
                                                    remove_fields.onclick = function(event){
                                                        event.preventDefault();
                                                      var input_tags = formfile.getElementsByTagName('input');
                                                      if(input_tags.length > 1) {
                                                        formfile.removeChild(input_tags[(input_tags.length) - 1]);
                                                      }
                                                    }        
                                                    
                                                    upload_img_vid.onclick=function(event){
                                                      event.preventDefault();
                                                      var newinput=document.createElement('input');
                                                      var oldinput=document.getElementsByClassName('inputfichier');
                                                      
                                                      newinput.type='file';
                                                      newinput.name='fichiers[]';
                                                      newinput.accept='image/*,video/mp4';
                                                      newinput.className='inputimgvid';
                                                      newinput.id='input'+i;
                                                        i=i+1;
                                                      newinput.addEventListener("change",function(){verification_image_video(this.id)});
                                                      while(oldinput.length>0){
                                                      formfile.removeChild(oldinput[0]);}
                                                      formfile.appendChild(newinput);
                                                      upload_img_vid.disabled=true;
                                                      upload_fichier.disabled=false;
                                                      
                                                    }
                                                    
                                                    upload_fichier.onclick=function(event){
                                                      event.preventDefault();
                                                      var newinput=document.createElement('input');
                                                      var oldinput=document.getElementsByClassName('inputimgvid');
                                                      newinput.type='file';
                                                      newinput.name='fichiers[]';
                                                      newinput.className='inputfichier';
                                                      newinput.id='input'+i;
                                                        i=i+1;
                                                      newinput.addEventListener("change",function(){verification_fichier(this.id)});
                                                      
                                                      while(oldinput.length>0){
                                                      formfile.removeChild(oldinput[0]);}
                                                      formfile.appendChild(newinput);
                                                      upload_img_vid.disabled=false;
                                                      upload_fichier.disabled=true;
                                                      
                                                    }
                                                    
                                                    
                                                    function verification_fichier(id){
                                                      
                                                      
                                                      
                                                        elm=document.getElementById(id);
                                                        
                                                        if(elm.value.search('.jpg|.mp4|.png|.jpeg')!=-1){
                                                          alert('type de fichier invalide');
                                                          elm.value='';
                                                    
                                                        }
                                                      
                                                    
                                                    }
                                                    function verification_image_video(id){
                                                      
                                                      
                                                      elm=document.getElementById(id);
                                                      
                                                      
                                                        if(elm.value.search('.jpg|.mp4|.png|.jpeg')==-1){
                                                          alert('type de fichier invalide');
                                                          elm.value='';
                                                    
                                                        }
                                                      
                                                    
                                                    }
                                                    
                                                        </script>
                                                  

   
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>




@endsection