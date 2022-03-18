@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')



    <div class="form">
        <div class="note">
          <h1>Modifier projet N:{{$project->id}}</h1>
        </div>


        <div class="form-content">
            <form action='/projet/{{$project->id}}' method="POST">
                @csrf
                @method('put')
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
{{-- hello --}}
{{-- nigger --}}
{{-- hey--}}

                    <div class="form-group">
                        <h6 class="mb-0"> Region Test:</h6>

                        <input type="text" class="form-control" placeholder="Region Test" name="RegionTest"/>
                    </div>

                     <div class="form-group">
                        <h6 class="mb-0"> Date Debut:</h6>

                        <input type="date"  class="form-control" id="birthday" name="DateDebut">
                    </div>
     
                   
                    <div class="form-group">
                        <h6 class="mb-0"> Date Fin:</h6>

                        <input type="date"  class="form-control" id="birthday" name="DateFin">
                    </div>


                    
                    <div class="form-group radio" style="    text-align:center ;">
                        <h6 class="mb-0" style="text-align: left"> Etude Echo:</h6>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                            <label class="form-check-label" for="inlineRadio1">oui</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">non</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" >
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

                       <input type="text"  id="chef" class="form-control " placeholder="Chef Projet" name="ChefProjet" disabled/>
                       <input type="hidden"  id="chefid" class="form-control " placeholder="ChefProjet" name="Chefid" />
                       
                     
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
                                                           
                                                           <th scope="row" style="text-align: center" class="rowdata">  {{$user->nom}}  </th>
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

                        <input type="text"  id="RepresentantE&P"  class="form-control" placeholder="Representant E&P" name="Representant E&P" disabled/>
                        <input type="hidden" id="RepresentantE&Pid"  class="form-control" name="RepresentantE&Pid"  />

                    


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
                                                            
                                                            <th scope="row" style="text-align: center" class="rowdata">  {{$user->nom}}  </th>
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

                            <h6 class="mb-0"> Equipe:</h6>

                            <input type="text" id="equipe"class="form-control" placeholder="Equipe" name="Equipe" disabled/>
                            <input type="hidden" id="equipeid"  class="form-control"  name="equipeid[]"/>





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
                                                                
                                                                <th scope="row" style="text-align: center" class="rowdata">  {{$user->nom}}  </th>
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
                <textarea class="form-control" rows="5"name="Description"></textarea>
              </div>

              <label>Visibilite:</label>
              <input type="range"  name="Visibilite" value="0" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%' ">
              <output>0%</output>

              <label>Reactivite:</label>
              <input type="range"  name="Reactivite" value="0" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
              <output>0%</output>
              
              <label>Avancement:</label>
              <input type="range"  name="Avancement" value="0" min="0" max="100" oninput="this.nextElementSibling.value = this.value+'%'">
              <output>0%</output>

            <button type="submit" class="btnSubmit">Submit</button>
            </form>
        </div>
 
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
        var pre = data[1].innerHTML;
   
        document.getElementById("RepresentantE&P").value = nom+'\xa0\xa0'+pre;
        document.getElementById("RepresentantE&Pid").value = rowId;
    }

    let a=[];
let b=[];

    function show3() {
        var rowId = 
            event.target.parentNode.parentNode.id;
      //this gives id of tr whose button was clicked
     
        var data = document.getElementById(rowId).querySelectorAll(".rowdata"); 
      /*returns array of all elements with 
      "row-data" class within the row with given id*/
      
        nom = data[0].innerHTML;
        pre = data[1].innerHTML;
       x=nom+'\xa0'+pre;
        a.push(x);
        b.push(rowId);

       alert(b);
     
   
      
        document.getElementById("equipe").value =a;
      
        document.getElementById("equipeid").value =b;
      
        
      
    }



  function clearf(){
    
   
    a=[];
     b=[];
     document.getElementById("equipe").value ='';
      
      document.getElementById("equipeid").value ='';

  }

</script>

@endsection


   