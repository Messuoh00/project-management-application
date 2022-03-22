@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')

@php
         $phase1=$project->phase;
         
         $phasenom='';
         $phasenom1="";
         switch ($phase1) {
             
        case 1.1:
            $phase1=1.2;   $phasenom1=' Maturation ';$phasenom='Idee R/D  ';
        break;
        
        case 1.2:
            $phase1=2.1;   $phasenom1='Recherche(En cours)';$phasenom='Maturation ';
        break;
        
        case 2.1:
            $phase1=2.2;   $phasenom='Recherche(En TEST)';$phasenom='Recherche(En cours) ';
        break;
        
        case 2.2:
            $phase1=3.1;   $phasenom='Archivage ';$phasenom='Recherche(En TEST) ';
         
            
        break;
        case 3.1:
   $phase1=3.1;   $phasenom1='Archivage ';$phasenom='Archivage';

   
break;
    
       
}
         
@endphp



    <div class="form">
        <div class="note">
          <h1>Modifier projet N:{{$project->id}}</h1>
        </div>


        <div class="form-content">
            <form action='/projet/{{$project->id}}' method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <h6 class="mb-0">Nom Projet:</h6>

                        <input type="text" class="form-control" value="{{$project->nom_projet}}" name="NomProjet"/>
                    </div>



                    <div class="form-group">
                        <h6 class="mb-0"> Thematique:</h6>

                        <input type="text" class="form-control"  value="{{$project->thematique}}" name="Thematique"/>
                    </div>
{{-- hello --}}
{{-- nigger --}}
{{-- hey--}}

                    <div class="form-group">
                        <h6 class="mb-0"> Region Test:</h6>

                        <input type="text" class="form-control" value="{{$project->region_test}}"  name="RegionTest"/>
                    </div>
                    
                    <div class="form-group">
                      <h6 class="mb-0"> Region Implementation:</h6>

                      <input type="text" class="form-control" value="{{$project->region_test}}"  name="RegionImp"/>
                  </div>
                  <div class="form-group">
                      <h6 class="mb-0"> Region Exploitation:</h6>

                      <input type="text" class="form-control" value="{{$project->region_test}}"  name="RegionExp"/>
                  </div>

                     <div class="form-group">
                        <h6 class="mb-0"> Date Debut:</h6>
                        
                        
                       

                        <input type="date"  class="form-control" id="birthday" value="{{ Carbon\Carbon::parse($project->date_deb)->format('Y-m-d') }}"  name="DateDebut"  onkeydown="return false">
                    </div>
     
                   
                    <div class="form-group">
                        <h6 class="mb-0"> Date Fin:</h6>

                        <input type="date"  class="form-control" id="birthday" value="{{ Carbon\Carbon::parse($project->date_fin)->format('Y-m-d') }}"  name="DateFin" onkeydown="return false">
                    </div>

                    <div class="form-group">
                      <h6 class="mb-0"> Phase:</h6>

                      <input type="text" class="form-control" value="{{$phasenom}}"  disabled/>
                     
                  </div>
                    
                    <div class="form-group radio" style="    text-align:center ;">
                        <h6 class="mb-0" style="text-align: left" > Etude Echo:</h6>
                
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="oui"  @if (  $project->etude_echo=="oui")  checked @endif>
                            <label class="form-check-label" for="inlineRadio1">oui</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="non"@if (  $project->etude_echo=="non")  checked @endif>
                            <label class="form-check-label" for="inlineRadio2">non</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="na" @if ( $project->etude_echo=="na")  checked @endif>
                            <label class="form-check-label" for="inlineRadio3">na</label>
                          </div>

                    </div>


                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <h6 class="mb-0"> Abreviation:</h6>

                        <input type="text" class="form-control"  value="{{$project->abreviation}}" name="Abreviation"/>
                    </div>

                    <div class="form-group" >
                        <h6 class="mb-0">Structure Pilote:</h6>

                        <div class="form-group col-md-4 " style="max-width: 100%">
                          
                            <select class="custom-select form-control "   name="StructurePilote" >
                                <option value="PED"  @if (  $project->structure_pilote=="PED")  selected @endif >PED</option>
                                <option value="DP"@if (  $project->structure_pilote=="DP")  selected @endif >DP</option>
                                <option value="AST"@if (  $project->structure_pilote=="AST")  selected @endif >AST</option>
                                <option value="EXP"@if (  $project->structure_pilote=="EXP")  selected @endif >EXP</option>
                                <option value="FOR"@if (  $project->structure_pilote=="FOR")  selected @endif >FOR</option>
                              
                              </select>
                        </div>

                    <div class="form-group">
                        <h6 class="mb-0"> budget:</h6>

                        <input type="number" class="form-control"value="{{$project->budget}}"  name="budget"/>
                    </div>

                    <div class="form-group ">
                       {{-- Chef Projet: --}}
                       <h6 class="mb-0"> Chef Projet:</h6>

                       <input type="text"  id="chef" class="form-control " value="{{$chef}}"  name="ChefProjet" disabled/>
                       <input type="hidden"  id="chefid" class="form-control " value="{{$project->chef_projet}}"  name="Chefid" />
                       
                     
                       <a data-toggle="modal" href="#myModal"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Chef Projet</a>

                       <div class="modal" tabindex="-1" role="dialog" id="myModal">
                           <div class="modal-dialog" role="document">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <h5 class="modal-title">Chef Projet</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                               </div>
                               <div class="modal-body">
                                                                                       
                                                       <table id="table"class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                       
                                                       <thead>
                                                           <tr style="text-align: center">
                                                           
                                                           <th scope="col" data-sortable="true">Nom</th>
                                                           <th scope="col" data-sortable="true">Prenom</th>
                                                           <th scope="col" data-sortable="true">Post</th>
                                                           <th scope="col" data-sortable="true">Division</th>
                                                           <th scope="col">select</th>


                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                       
                                                           @foreach ($users as $user)
                                                       
                                                           <tr id={{$user->id}}>
                                                           
                                                            <th scope="row" style="text-align: center" class="rowdata"><a href="users/{{$user->id}}}">  {{$user->nom}} </a> </th>
                                                           <td style="text-align: center" class="rowdata"> {{$user->prenom}}</td>
                                                           <td style="text-align: center" class="rowdata"> {{$user->poste}} </td>
                                                           <td style="text-align: center" class="rowdata"> {{$user->division}} </td>
                                                           <td><input type="button"value="submit"onclick="show()"data-dismiss="modal" /> </td>
                                                           
                                                           </tr>
                                                           
                                                           @endforeach

                                                       </tbody>

                                                       </table>           
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Feremr</button>
                              
                               </div>
                             </div>
                           </div>
                         </div>


                    
                    </div>

                    <div class="form-group">
                        {{-- Representant E&P --}}
                        <h6 class="mb-0"> Representant E&P:</h6>

                        <input type="text"  id="RepresentantE&P"  class="form-control"  value="{{$rep}}"  name="Representant E&P" disabled/>
                        <input type="hidden" id="RepresentantE&Pid"  class="form-control" name="RepresentantE&Pid"   value="{{$project->representant_EP}}"  />

                    


                        <a data-toggle="modal" href="#myModal2"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Representant E&P</a>

                        <div class="modal" tabindex="-1" role="dialog" id="myModal2">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Representant E&P</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                                                                        
                                                        <table id="table"class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                        
                                                        <thead>
                                                            <tr style="text-align: center">
                                                            
                                                            <th scope="col" data-sortable="true">Nom</th>
                                                            <th scope="col" data-sortable="true">Prenom</th>
                                                            <th scope="col" data-sortable="true">Post</th>
                                                           
                                                            <th scope="col">select</th>


                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        
                                                            @foreach ($users as $user)
                                                        
                                                            <tr id={{$user->id}}>
                                                              <th scope="row" style="text-align: center" class="rowdata"><a href="users/{{$user->id}}}">  {{$user->nom}} </a> </th>
                                                            <td style="text-align: center" class="rowdata"> {{$user->prenom}}</td>
                                                            <td style="text-align: center" class="rowdata"> {{$user->poste}} </td>
                                                           
                                                            <td><input type="button"value="submit"onclick="show2()"data-dismiss="modal" /> </td>
                                                            
                                                            </tr>
                                                            
                                                            @endforeach

                                                        </tbody>

                                                        </table>           
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >Feremr</button>
                               
                                </div>
                              </div>
                            </div>
                          </div>




                    </div>

                    <div class="form-group">
                            {{-- Equipe --}}

                            <h6 class="mb-0">Equipe:</h6>

                            <div  style="overflow-y: scroll; height:140px;"  id="equipe"class="form-control"  name="Equipe" placeholder="Equipe"type="text" ></div>

                            <input type="hidden" id="equipeid"  class="form-control"   name="equipeid[]"/>





                            <div class="clear">
                            <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Equipe</a>
                              



                            <button type="button"  class="btn btn-warning btn-sm " onclick="clearf()">Clear input field</button>

                            </div>

                            <div class="modal" tabindex="-1" role="dialog" id="myModal3">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Equipe</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                                                                            
                                                            <table id="table"class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            
                                                            <thead>
                                                                <tr style="text-align: center">
                                                                
                                                                <th scope="col" data-sortable="true">Nom</th>
                                                                <th scope="col" data-sortable="true">Prenom</th>
                                                                <th scope="col" data-sortable="true">Post</th>
                                                              
                                                                <th scope="col">select</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            
                                                                @foreach ($users as $user)
                                                            
                                                                <tr id={{$user->id}}>
                                                                
                                                                  <th scope="row" style="text-align: center" class="rowdata"><a href="users/{{$user->id}}}">  {{$user->nom}} </a> </th>
                                                                <td style="text-align: center" class="rowdata"> {{$user->prenom}}</td>
                                                                <td style="text-align: center" class="rowdata"> {{$user->poste}} </td>
                                                              
                                                                <td><input type="button"value="submit"onclick="show3()" /> </td>
                                                                
                                                                </tr>
                                                                
                                                                @endforeach

                                                            </tbody>

                                                            </table>           
                                    </div>


                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Feremr</button>
                                  
                                    </div>
                                  </div>
                                </div>
                              </div>
                      
                    </div>


                </div>
            </div>







            
            <div class="form-group">
                <label for="comment">Description:</label>
                <textarea class="form-control" rows="5"name="Description"  >{{$project->description}}</textarea>
              </div>

              <label>Visibilite:</label>
              <input type="range"  name="Visibilite" value="{{$project->visibilite}}" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%' ">
              <output>{{$project->visibilite}}%</output>

              <label>Reactivite:</label>
              <input type="range"  name="Reactivite" value="{{$project->reactivite}}" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
              <output>{{$project->reactivite}}%</output>
              
              <label>Avancement:</label>
              <input type="range"  name="Avancement" value="{{$project->avancement}}" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
              <output>{{$project->avancement}}%</output>

              {{-- <h6 class="mb-0" style=> Ajouter Fichier:</h6>
              <div class="box">
               
                <div class="behinde"> 
                   <input type="file" name="file" id="file" class="file" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                 </div>
            
                <div class="front">
                <label  for="file" class="lab">
                  <div style="border: 1px dashed black ;width:40% ;margin:auto;"> 
                  <br>
                    <img id="pdfimg" src="{{url('/img/pdf-icon.jpg')}}" style="width:70px" >
                    <br>
                    <span class="file-name">Aucun fichier</span>
                
                  </div>
                  
                  </label>
                </div>
                </div> --}}
                
            </div>
            

             <br>
             <br>


             

            <div class="butt">
              
            

            <div class="son son1">
               <!-- Button trigger modal -->
               <button type="button" class="btn btnSubmit" style="background: grey;" data-toggle="modal" data-target="#exampleModalCenter">
                Ajouter un fichier
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un fichier</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                     @switch($project->phase)
                         @case(1.1)
                             <span>Aucun fichier a ajour dans la phase {{$phasenom}}</span>
                             @break
                          
                         @case(1.2)
                         <label class="form-label">note</label>
                         <input class="form-control form-control-sm" id="note"  name="note"  type="file" accept= "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                         <br>
                         <label  class="form-label">fiche projet</label>
                         <input class="form-control form-control-sm" id="fiche"  name="fiche"  type="file" accept= "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                             @break 
                             
                         @case(2.1)
                             
                             @break 
                             
                         @case(2.2)
                             
                             @break 
                             
                         @case(3.1)
                        
                         
                      
                             @break

                             
                         @default
                             
                     @endswitch
                    </div>
                    <div class="modal-footer">
                     
                      <button type="button" class="btn btn-primary"  data-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>
               {{-- FORM N2 START HERE  FOR PASSAGE --}}
            </div>


           
             
            

            <div class="son son2">
                  
<button type="button" class="btnSubmit " data-toggle="modal" data-target="#exampleModal">
  Confirmer Modification
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Appliquer Modification ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        
        <button type="submit" name="updateall" class="btn btn-warning"> Appliquer</button>

      </div>
    </div>
  </div>
</div>  



            </div>
            </form>



           
            <!-- Modal -->
            
        

 

 
    </div>





    
<script>
    function show() {
        var rowId = 
            event.target.parentNode.parentNode.id;
      //this gives id of tr whose button was clicked
     
        var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
      /*returns array of all elements with 
      "row-data" class within the row with given id*/
     
        var nom = data[0].innerHTML;
        nom=nom.substring(20, nom.length-4);
        var pre = data[1].innerHTML;
   
        document.getElementById("chef").value = nom+'\xa0\xa0'+pre;
        document.getElementById("chefid").value = rowId;
    }

    function show2() {
        var rowId = 
            event.target.parentNode.parentNode.id;
      //this gives id of tr whose button was clicked
     
        var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
      /*returns array of all elements with 
      "row-data" class within the row with given id*/
     
        var nom = data[0].innerHTML;
        nom=nom.substring(20, nom.length-4);
        var pre = data[1].innerHTML;

        
   
        document.getElementById("RepresentantE&P").value = nom+'\xa0\xa0'+pre;
        document.getElementById("RepresentantE&Pid").value = rowId;
    }

let a=[];
let b=[];

 
  Array.prototype.push.apply(a,@json($equipe));
  Array.prototype.push.apply(b,@json($ei));
  
  a.forEach(element => {
    var memberequipe = document.createElement('p')
      
      var text = document.createTextNode(element);
       memberequipe.appendChild(text); 
      var daddy=document.getElementById("equipe")
 
   
       daddy.appendChild(memberequipe);
    
   
      
  });
  document.getElementById("equipe").value =a;
      
  document.getElementById("equipeid").value =b;

    function show3() {
        var rowId = 
            event.target.parentNode.parentNode.id;
      //this gives id of tr whose button was clicked
     
        var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
      /*returns array of all elements with 
      "row-data" class within the row with given id*/
      
        nom = data[0].innerHTML;
        pre = data[1].innerHTML;
        nom=nom.substring(20, nom.length-4);
       x=nom+' '+pre;
        a.push(x);
        b.push(rowId);

     
      var memberequipe = document.createElement('p')
      
      var text = document.createTextNode(x);
       memberequipe.appendChild(text); 
      var daddy=document.getElementById("equipe")
 
   
       daddy.appendChild(memberequipe);
    
   
      
   
      
        document.getElementById("equipeid").value =b;
      
        
      
    }



  function clearf(){
    
   

    a=[];
    b=[];
    const myNode = document.getElementById("equipe");
      myNode.innerHTML = '';

     document.getElementById("equipe").value ='';
      
      document.getElementById("equipeid").value ='';

  }


//   const file = document.querySelector('#file');
// file.addEventListener('change', (e) => {
//   // Get the selected file
//   const [file] = e.target.files;
//   // Get the file name and size
//   const { name: fileName, size } = file;
//   // Convert size in bytes to kilo bytes
//   const fileSize = (size / 1000).toFixed(2);
//   // Set the text content
//   const fileNameAndSize = `${fileName} - ${fileSize}KB`;
//   document.querySelector('.file-name').textContent = fileNameAndSize+'\xa0 \xa0 ✓';
// });



</script>

@endsection


   