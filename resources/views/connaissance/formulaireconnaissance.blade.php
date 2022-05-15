@extends('layout.main')


@section('styles')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="{{ asset('css/formulairepub.css') }}" rel="stylesheet" type="text/css"  >


@endsection





@section('content')




                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Ajouter une Connaissance</h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                


                                                    <div class="pere" id="pere">
                                                    <form method="post" action="{{url('/connaissances')}}" enctype="multipart/form-data"  >
                                                        {{csrf_field()}}
                                                      
                                                        
                                                        <label  >text de la connaissance(non obligatoire):</label>
                                                        <textarea class=" text-corps form-control" rows="5" name="commentaire"></textarea>
                                                       <div id="upload">
            
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
                                                        <div id='divpublierbtn'> 
                                                        <input id='publierbtn' type="submit" class="btn btn-warning" value='publier'>


                                                        </div>

                                                        
                                                      
                                                      </form>
                                                    
                                            
                                                    
                                                        
                                                        </div>
                                                      
                                                    
                                                    
                                                       
                                                  

   
                                                </div>
                                                
                                            </div>
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
                        fichiers.push(file);
                        
                    
                        
                        if(file){
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
                            console.log(input1.files)

                    }
        
        

        </script>




@endsection