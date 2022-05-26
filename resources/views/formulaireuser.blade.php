@extends('layout.main')


@section('styles')


<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >


@endsection





@section('content')
@php
$routefichier=storage_path('app\fichier-excel');

    


$fichier=\File::files($routefichier);

if(!empty($fichier)){
    
$file_path=pathinfo($fichier[0])['dirname'].'/'.pathinfo($fichier[0])['basename'];

$fichier=File::get(storage_path('app\fichier-excel'.'/'.pathinfo($fichier[0])['basename']));
}else{
    $fichier='';
}


    
@endphp






                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800"> Creation d'un utilisateur</h1>
                                
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                                                                                                                
                                                                                              
                                                                                                <div class="container">
                                                              
                                                                                                
                                                                                                
                                                                                                    <hr>
                                                                                                    <a data-toggle="modal" href="#myModal"  class="btn btn-warning btn-sm " style="margin:10px">contacts outlook</a>

                                                                                                    <a data-toggle="modal" href="#myModal2"  class="btn btn-warning btn-sm " style="margin:10px">importer un fichier excel des contacts outlook</a>
                                                                                                
                                                                                                
                                                                                                    <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                                                                                                        <div class="modal-dialog" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <h5 class="modal-title">contacts outlook</h5>
                                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                            @if($fichier=='')
                                                                                                                                le fichier excel n'a pas importé
                                                                                                                                @endif
                                                                                                                                
                                                                                                                                
                                                                                                                                

                                                                                                                                                                                                                                       

                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div>
                                                                                                                        </div>
                                                                                                



                                                                                                                        <div class="modal" tabindex="-1" role="dialog" id="myModal2">
                                                                                                                        <div class="modal-dialog" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <h5 class="modal-title">contacts outlook</h5>
                                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                            <form method="post" action="{{url('/importexcel')}}" enctype="multipart/form-data" >
                                                                                                                                {{csrf_field()}}
                                                                                                                                <input name='fichier' onchange="testext(this)" type="file" accept=".csv">
                                                                                                                                <button type="submit" class="btn btn-warning">importer</button>

                                                                                                                                </form> 

                                                                                                                                                                                                                                       

                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div>
                                                                                                                        </div>
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                
                                                                                                    <form method="post" action="{{url('/users')}}" >
                                                                                                    {{csrf_field()}}
                                                                                                    <div class="form-group input-group">
                                                                                                        
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="nom" name="nom" class="form-control" placeholder="nom" type="text">
                                                                                                       
                                                                                                    
                                                                                                    </div>
                                                                                                    @if($errors->has('nom'))
                                                                                                        <div><span style="color: red">{{$errors->first('nom')}}</span></div>
                                                                                                                @endif
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="prenom" name="prenom" class="form-control" placeholder="prenom" type="text">
                                                                                                    </div>
                                                                                                    @if($errors->has('prenom'))
                                                                                                        <div><span style="color: red">{{$errors->first('prenom')}}</span></div>
                                                                                                                @endif
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="email" name="email" class="form-control" placeholder="adresse email" type="email">
                                                                                                    </div>
                                                                                                    @if($errors->has('email'))
                                                                                                        <div><span style="color: red">{{$errors->first('email')}}</span></div>
                                                                                                                @endif

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="password" name="password" class="form-control" placeholder="mot de passe " type="password">
                                                                                                    </div>
                                                                                                    @if($errors->has('password'))
                                                                                                        <div><span style="color: red">{{$errors->first('password')}}</span></div>
                                                                                                                @endif
                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fas fa-key"></i> </span>
                                                                                                        </div>
                                                                                                        <input id="password2" name="password2" class="form-control" placeholder=" confirmation mot de passe " type="password">
                                                                                                    </div>
                                                                                                    @if($errors->has('password2'))
                                                                                                        <div><span style="color: red">{{$errors->first('password2')}}</span></div>
                                                                                                                @endif
                                                                                                                @if($message=Session::get('error'))                                                                                              
                                                                                        
                                                                                                                    <div><span style="color: red">{{Session::get('error')}}</span></div>
                                                                                                                            @endif

                                                                                                    

                                                                                                    <div class="form-group input-group">
                                                                                                        <div class="input-group-prepend">
                                                                                                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                                                                                        </div>
                                                                                                        <select class="form-control form-select" name="division" id="division">
                                                                                                            @foreach ($dep as $d)
						
                                                                                                            <option value="{{$d->id}}"  >{{$d->nomdep}}</option>
                                                                                                           
                                                        
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <a style="margin-top: 10px; margin-bottom:10px" data-toggle="modal" href="#myModal10" class="btn btn-warning">selectionner le role</a>

                                                                                                    <div id="divnomrole" style="position:relative" class="form-control">
                                                                                                        
                                                                                                    
                                                                                             
                                                                                                    

                                                                                                    </div>
                                                                                                    <input id="inputidrole" name="role" type="hidden" >
                                                                                                    @if($errors->has('role'))
                                                                                                        <div><span style="color: red">{{$errors->first('role')}}</span></div>
                                                                                                                @endif
                                                                                                   
                                                                                                              
                                                                                                    <button style="margin-top: 10px ;" type="submit" class="btn btn-warning">Enregistrer</button>

                                                                                                </form> 

                                                                                                </div>
        





                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal" tabindex="-1" role="dialog" id="myModal10">
                                                                                                                        <div class="modal-dialog" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <h5 class="modal-title">ajouter un role</h5>
                                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                            <h6 class="mb-0"> liste des accès :</h6>
                                                                                                                            <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                                                                                            <thead>
                                                                                                                                    <tr>
                                                                                                                                    <th scope="col" data-sortable="true">nom du role </th>  
                                                                                                                                           
                                                                                                                                    
                                                                                                                                    </tr>
                                                                                                                                </thead>
                                                                    
                                                                                                                                <tbody>
                                                                                                                                
                                                                                                                                @foreach($roles as $role)
                                                                                                                                
                                                                                                                                <tr>
                                                                                                                                <td > <div data-dismiss='modal' class="row_role_nom" style="width:100%;padding:25px;cursor:pointer"  onclick="selectionnerrole(this,{{$role->id}})" >{{$role->nom_role}}</div></td>
                                                                                                                            
                                                                                                                                
                                                                                                                                
                                                                    
                                                                                                                                <!-- Modal -->
                                                                                        
                                                                                                                                </tr>
                                                                                                                                @endforeach
                                                                                                                            </tbody>
                                                                                                                            </table>
                                                                
                                                                                     
                                                                                                                            
                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div> 
                                                             </div>  


                           
                           <script>
                               row_role_nom=document.getElementsByClassName('row_role_nom');
                               console.log(row_role_nom[0].innerHTML);
                               divrole=document.getElementById('divnomrole');
                               console.log(divrole.innerHTML);
                                   input_id_role=document.getElementById('inputidrole');
                               function selectionnerrole(caller,id){
                                   
                                  
                                   
                                   
                                   divrole.innerHTML=caller.innerHTML +'<i onclick="enleverrole()"style="color:red;cursor:pointer;position:absolute; top:30%; right:10px" class=" iconetimes fa fa-times"  aria-hidden="true"></i>';
                                   input_id_role.value=id;
                               }
                               function enleverrole(){
                                   divrole.innerHTML='';
                                   input_id_role.value=null;
                               }
                               function testext(caller){
                                   
                                   if(caller.files[0].name.split('.').pop().toLowerCase()!='csv'){
                                       caller.value=''
                                       alert("ce type de fichier n'est pas accepté ")
                                   }
                               }
function ArrayToHtmlTable(htmlelement,ArrayObject) {
                TableHeader = Object.keys(ArrayObject[0])
                    .map((x) => "<th scope='col' data-sortable='true'>" + x + "</th>")
                    .join("");
                    TableHeader="<thead> <tr style='text-align: center'>"+TableHeader+"</tr> </thead>"
                    

                TableBody = ArrayObject.map(
                    (x) =>    
                    "<tr> " +
                    Object.values(x)
                        .map((x) => "<td data-dismiss='modal' style='padding:0;'> <div class='row-contact' onclick='importercontact(this)' style='padding:10px;width:100%;cursor:pointer' > "+x+" </div> </td>")
                        .join() +
                    "</tr>"
                ).join("");
                TableBody="<tbody>"+TableBody+"</tbody>";
                splitable=TableBody.split('</td>');
                TableBody="";
                for(i=0;i<splitable.length;i++){
                    (splitable[i][0]!=',')?TableBody=TableBody+splitable[i]:TableBody=TableBody+splitable[i].substring(1);

                }
                
                document.getElementsByClassName(
                    htmlelement
                )[0].innerHTML += `<table id="table"class="table table-sm " data-toggle="table" data-search="true"  data-pagination="true"> ${TableHeader} ${TableBody}</table>`;
     }
       



function csvToArray(str, delimiter = ",") {
            const headers = str.slice(0, str.indexOf("\n")).split(delimiter);
            const rows = str.slice(str.indexOf("\n") + 1).split("\n");
            const arr = rows.map(function (row) {
                const values = row.split(delimiter);
                const el = headers.reduce(function (object, header, index) {
                object[header] = values[index];
                return object;
                }, {});
                return el;
            });
            // return the array
            return arr;
}

function importercontact(caller){
    nom=document.getElementById('nom');
    prenom=document.getElementById('prenom');
    email=document.getElementById('email');
    
    colonnes=caller.parentNode.parentNode.getElementsByClassName('row-contact');
    nom.value=colonnes[0].innerHTML;
    prenom.value=colonnes[1].innerHTML;
    email.value=colonnes[2].innerHTML;

    
    
}
       
       




var fichier = @json($fichier);
if(fichier!=''){
       const firstname="﻿First Name";
       var data = csvToArray(fichier);
     
       var newdata=[];
       data.map((contact)=>{ 
           if((contact["﻿First Name"]!='')&& (contact["Last Name"]!='')&& (contact["E-mail Address"]!='')  ){
            newdata.push({nom:contact["Last Name"],prenom:contact["﻿First Name"]+' '+contact["Middle Name"],email:contact["E-mail Address"]});}})
            

            ArrayToHtmlTable("modal-body",newdata);
           }

            



      
       
   </script>


@endsection