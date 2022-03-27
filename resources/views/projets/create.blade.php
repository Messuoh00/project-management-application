@extends('layout.main')

@section('styles')

<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >
<link href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">


@endsection


@section('content')

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ajouter un Projet</h1>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Pending Requests Card Example -->
    <div class="col">
        <div class="card ">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col ">
                       
                                    
                                                                

                                  <div class="form">
                                 

                                  <div class="form-content">
                                  <form action="{{route('projet.store')}}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                  <div class="col-md-6">

                                  <div class="form-group">
                                  <h6 class="mb-0">Nom Projet:</h6>

                                  <input type="text" class="form-control" placeholder="NomProjet" name="NomProjet"/>
                                  </div>

                                  <div class="form-group">
                                  <h6 class="mb-0"> Thematique:</h6>

                                  <input type="text" class="form-control" placeholder="Thematique" name="Thematique"/>
                                  </div>


                                  <div class="form-group">
                                  <h6 class="mb-0"> Region Test:</h6>

                                  <input type="text" class="form-control" placeholder="RegionTest" name="RegionTest"/>
                                  </div>

                                  <div class="form-group">
                                  <h6 class="mb-0"> Region Implementation:</h6>

                                  <input type="text" class="form-control" placeholder="Region Implementation"  name="RegionImp"/>
                                  </div>
                                  <div class="form-group">
                                  <h6 class="mb-0"> Region Exploitation:</h6>

                                  <input type="text" class="form-control" placeholder="Region Exploitation"  name="RegionExp"/>
                                  </div>


                                  <div class="form-group">
                                  <h6 class="mb-0"> Date Debut:</h6>

                                  <input type="date"  class="form-control" id="birthday" name="DateDebut" onkeydown="return false">
                                  </div>


                                  <div class="form-group">
                                  <h6 class="mb-0"> Date Fin:</h6>

                                  <input type="date"  class="form-control" id="birthday" name="DateFin" onkeydown="return false">
                                  </div>

                                  <div class="form-group radio" style="    text-align:center ;">
                                  <h6 class="mb-0" style="text-align: left"> Etude Echo:</h6>

                                  <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="oui" checked>
                                  <label class="form-check-label" for="inlineRadio1">oui</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="non">
                                  <label class="form-check-label" for="inlineRadio2">non</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="na" >
                                  <label class="form-check-label" for="inlineRadio3">na</label>
                                  </div>

                                  </div>


                                  </div>



                                  <div class="col-md-6">
                                  <div class="form-group">
                                  <h6 class="mb-0"> Abreviation:</h6>

                                  <input type="text" class="form-control" placeholder="Abreviation" name="Abreviation"/>
                                  </div>

                                  <div class="form-group" >
                                  <h6 class="mb-0">Structure Pilote:</h6>

                                  <div class="form-group col-md-4 " style="max-width: 100%">

                                  <select class="custom-select form-control "   name="StructurePilote" >
                                      <option selected value="PED">PED</option>
                                      <option value="DP">DP</option>
                                      <option value="AST">AST</option>
                                      <option value="EXP">EXP</option>
                                      <option value="FOR">FOR</option>
                                    
                                    </select>
                                  </div>

                                  <div class="form-group">
                                  <h6 class="mb-0"> budget:</h6>

                                  <input type="number" class="form-control" placeholder="budget" name="budget"/>
                                  </div>

                                  <div class="form-group ">
                                  {{-- Chef Projet: --}}
                                  <h6 class="mb-0"> Chef Projet:</h6>


                                  <div  type="text" id="chef"class="form-control"  name="ChefProjet"  > </div>
                                  <input type="hidden"  id="chefid" class="form-control " placeholder="ChefProjet" name="Chefid" />


                                  <a data-toggle="modal" href="#myModal"  class="btn btn-warning btn-sm " style="margin:10px">Choisir Chef Projet</a>
                                  <button type="button"  class="btn btn-warning btn-sm " onclick="clear1()">annuler</button>


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
                                                                  
                                                                <th scope="row" style="text-align: center" class="rowdata"><a href="/users/{{$user->id}}}">  {{$user->nom}} </a> </th>
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
                                        <button type="button" class="btn btn-secondary"data-dismiss="modal" >Feremr</button>
                                    
                                      </div>
                                    </div>
                                  </div>
                                  </div>


                                  </div>

                                  <div class="form-group">
                                  {{-- Representant E&P --}}
                                  <h6 class="mb-0"> Representant E&P:</h6>

                                  <div   type="text"   id="RepresentantE&P"  class="form-control"  name="Representant E&P" placeholder="Representant E&P" > </div>
                                  <input type="hidden" id="RepresentantE&Pid"  class="form-control" name="RepresentantE&Pid"  />




                                  <a data-toggle="modal" href="#myModal2"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Representant E&P</a>
                                  <button type="button"  class="btn btn-warning btn-sm " onclick="clear2()">annuler</button>
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
                                                                  
                                                                  <th scope="row" style="text-align: center" class="rowdata"><a href="/users/{{$user->id}}}">  {{$user->nom}} </a> </th>
                                                                  <td style="text-align: center" class="rowdata"> {{$user->prenom}}</td>
                                                                  <td style="text-align: center" class="rowdata"> {{$user->poste}} </td>
                                                                
                                                                  <td><input type="button"value="submit"onclick="show2()"data-dismiss="modal" /> </td>
                                                                  
                                                                  </tr>
                                                                  
                                                                  @endforeach

                                                              </tbody>

                                                              </table>           
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"data-dismiss="modal" >Feremr</button>
                                    
                                      </div>
                                    </div>
                                  </div>
                                  </div>



                                  </div>

                                  <div class="form-group">
                                  {{-- Equipe --}}

                                  <h6 class="mb-0"> Equipe:</h6>

                                  <div  style="overflow-y: scroll; height:140px;"  id="equipe"class="form-control"  name="Equipe" placeholder="Equipe"type="text" ></div>

                                  <input type="hidden" id="equipeid"  class="form-control"  name="equipeid[]"/>





                                  <div class="clear">
                                  <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Equipe</a>




                                  <button type="button"  class="btn btn-warning btn-sm " onclick="clearf()">annuler</button>

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
                                                                  <th scope="col" data-sortable="true">Division</th>
                                                                  <th scope="col">select</th>


                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                              
                                                                  @foreach ($users as $user)
                                                              
                                                                  <tr id={{$user->id}}>
                                                                  
                                                                    <th scope="row" style="text-align: center" class="rowdata"><a href="/users/{{$user->id}}}">  {{$user->nom}} </a> </th>
                                                                  <td style="text-align: center" class="rowdata"> {{$user->prenom}}</td>
                                                                  <td style="text-align: center" class="rowdata"> {{$user->poste}} </td>
                                                                  <td style="text-align: center" class="rowdata"> {{$user->division}} </td>
                                                                  <td><input type="button"value="submit"onclick="show3()" /> </td>
                                                                  
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


                                  </div>


                                  </div>

                                  <div class="form-group">
                                  <h6 class="mb-0"> Description:</h6>
                                  <textarea class="form-control" rows="5"name="Description"></textarea>
                                  </div>



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
                                  <span  class="file-name">Aucun fichier</span>
                                  </div>

                                  </label>
                                  </div>
                                  </div> --}}

                                  </div>


                                  <br>
                                  <br>
                                  <div style="display: grid; grid; grid-template-columns: 1fr 1fr;">
                                  <div></div>
                                  <div style="text-align:right;">
                                  <button type="submit" class="btnSubmit">Confirmer</button>
                                  </div>
                                  </div>
                                  </form>
                                  </div>

                                  </div>






                                  <script>
                                  function show() {



                                  var daddy=document.getElementById("chef");
                                  daddy.innerHTML='';
                                  var rowId = 
                                  event.target.parentNode.parentNode.id;
                                  //this gives id of tr whose button was clicked

                                  var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
                                  /*returns array of all elements with 
                                  "row-data" class within the row with given id*/

                                  var nom = data[0].innerHTML;
                                  nom=nom.substring(21, nom.length-4);
                                  var pre = data[1].innerHTML;
                                  x=nom+' '+pre;

                                  var memberequipe = document.createElement('p');

                                  var text = document.createTextNode(x);
                                  memberequipe.appendChild(text); 

                                  var link = document.createElement('a');

                                  link.href="/users/"+rowId;
                                  link.appendChild(memberequipe);



                                  daddy.appendChild(link);

                                  document.getElementById("chefid").value = rowId;
                                  }

                                  function show2() {

                                  var daddy=document.getElementById("RepresentantE&P");
                                  daddy.innerHTML='';

                                  var rowId = 
                                  event.target.parentNode.parentNode.id;
                                  //this gives id of tr whose button was clicked

                                  var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
                                  /*returns array of all elements with 
                                  "row-data" class within the row with given id*/

                                  var nom = data[0].innerHTML;
                                  nom=nom.substring(21, nom.length-4);
                                  var pre = data[1].innerHTML;
                                  x=nom+' '+pre;

                                  var memberequipe = document.createElement('p');

                                  var text = document.createTextNode(x);
                                  memberequipe.appendChild(text); 

                                  var link = document.createElement('a');

                                  link.href="/users/"+rowId;
                                  link.appendChild(memberequipe);



                                  daddy.appendChild(link);


                                  document.getElementById("RepresentantE&Pid").value = rowId;
                                  }


                                  let b=[];

                                  function show3() {
                                  var rowId = 
                                  event.target.parentNode.parentNode.id;
                                  //this gives id of tr whose button was clicked
                                  if ( !(b.includes(rowId) ) ) {


                                  var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
                                  /*returns array of all elements with 
                                  "row-data" class within the row with given id*/

                                  nom = data[0].innerHTML;
                                  pre = data[1].innerHTML;
                                  nom=nom.substring(21, nom.length-4);
                                  x=nom+' '+pre;

                                  b.push(rowId);


                                  var memberequipedad = document.createElement('p');

                                  var memberequipe = document.createElement('span');

                                  var text = document.createTextNode(x);
                                  memberequipe.appendChild(text); 

                                  var link = document.createElement('a')

                                  link.href="/users/"+rowId;
                                  link.appendChild(memberequipe);
                                  memberequipedad.appendChild(link);

                                  var button = document.createElement('button');
                                  button.innerHTML = '&times;';
                                  button.classList.add("close");
                                  button.setAttribute('type','button');
                                  button.onclick = function(){

                                  var index = b.indexOf(rowId);
                                  if (index !== -1) {
                                  b.splice(index, 1);
                                  document.getElementById("equipeid").value=b;
                                  } 
                                  button.parentNode.parentNode.removeChild(button.parentNode);

                                  };



                                  var daddy=document.getElementById("equipe");

                                  memberequipedad.appendChild(button);
                                  daddy.appendChild(memberequipedad);



                                  document.getElementById("equipeid").value=b;
                                  }


                                  }


                                  function clear1(){




                                  const myNode = document.getElementById("chef");
                                  myNode.innerHTML = '';

                                  document.getElementById("chef").value ='';

                                  document.getElementById("chefid").value ='';

                                  }

                                  function clear2(){




                                  const myNode = document.getElementById("RepresentantE&P");
                                  myNode.innerHTML = '';

                                  document.getElementById("RepresentantE&P").value ='';

                                  document.getElementById("RepresentantE&Pid").value ='';

                                  }


                                  function clearf(){



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
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>





@endsection


    
