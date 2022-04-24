@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Modifier projet N:  <a href="/projet/{{$project->id}}">{{$project->id}}</a> </h1>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Pending Requests Card Example -->
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col ">


                                @php
                                $nomphase = array("Idee R/D Non Valider", "Idee R/D", "Maturation", "Recherche(En cours)",'Recherche(En TEST)','Archivage','En implementation','En exploitation');


                                @endphp



                                <div class="form">


                                <div class="form-content">
                                <form action='/projet/{{$project->id}}' method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <h6 class="mb-0">Nom Projet:</h6>

                                            <input type="text" class="form-control" value="{{$project->nom_projet}}" name="NomProjet"/>
                                            @if($errors->has('NomProjet'))
                                            <div><span style="color: red">Saisissez le nom du projet</span></div>
                                        @endif
                                        </div>



                                        <div class="form-group">
                                            <h6 class="mb-0"> Thematique:</h6>

                                            <input type="text" class="form-control"  value="{{$project->thematique}}" name="Thematique"/>
                                            @if($errors->has('Thematique'))
                                            <div><span style="color: red">Saisissez la Thematique du projet</span></div>
                                            @endif
                                        </div>
                                {{-- hello --}}
                                {{-- nigger --}}
                                {{-- hey--}}

                                        <div class="form-group" @if ($project->phase<4) hidden @endif>
                                            <h6 class="mb-0"> Region Test:</h6>

                                            <input type="text" class="form-control" value="{{$project->region_test}}"  name="RegionTest"/>
                                            @if($errors->has('RegionTest'))
                                            <div><span style="color: red">Saisissez la Region Test du projet</span></div>
                                            @endif
                                        </div>

                                        <div class="form-group" @if ($project->phase<5) hidden @endif>
                                            <h6 class="mb-0"> Region Implementation:</h6>

                                            <input type="text" class="form-control" value="{{$project->region_implementation}}"  name="RegionImp"/>
                                            @if($errors->has('RegionImp'))
                                            <div><span style="color: red">Saisissez la Region Implementation du projet</span></div>
                                            @endif
                                        </div>
                                        <div class="form-group" @if ($project->phase<6) hidden @endif>
                                            <h6 class="mb-0"> Region Exploitation:</h6>

                                            <input type="text" class="form-control" value="{{$project->region_exploitation}}"  name="RegionExp"/>
                                            @if($errors->has('RegionExp'))
                                            <div><span style="color: red">Saisissez la Region Exploitation du projet</span></div>
                                            @endif
                                        </div>

                                            <div class="form-group">
                                            <h6 class="mb-0"> Date Debut:</h6>


                                            <input type="date"  class="form-control" id="birthday" value="{{ Carbon\Carbon::parse($project->date_deb)->format('Y-m-d') }}"  name="DateDebut"  onkeydown="return false">
                                            @if($errors->has('DateDebut'))
                                            <div><span style="color: red">Saisissez la Date de debut du projet</span></div>
                                            @endif
                                        </div>


                                        <div class="form-group">
                                            <h6 class="mb-0"> Date Fin:</h6>

                                            <input type="date"  class="form-control" id="birthday" value="{{ Carbon\Carbon::parse($project->date_fin)->format('Y-m-d') }}"  name="DateFin" onkeydown="return false">
                                            @if($errors->has('DateFin'))
                                            <div><span style="color: red">la Date de début doit être inférieur Date de fin </span></div>
                                            @endif

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


                                        @if ($project->phase==0 ||$project->phase==2)

                                        <div class="form-group radio" style="text-align:center ;">
                                            <h6 class="mb-0" style="text-align: left" > Validation:</h6>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="extras" id="inlineRadio4" value="accord"  @if (  $project->extras=="accord")  checked @endif>
                                                <label class="form-check-label" for="inlineRadio1">accord</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="extras" id="inlineRadio5" value="complément d'information"@if (  $project->extras=="complément d'information")  checked @endif>
                                                <label class="form-check-label" for="inlineRadio2">complément d'information</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="extras" id="inlineRadio6" value="refus" @if ( $project->extras=="refus")  checked @endif>
                                                <label class="form-check-label" for="inlineRadio3">refus</label>
                                                </div>

                                        </div>

                                        @endif

                                        <div class="form-group">
                                            <h6 class="mb-0"> Phase:</h6>

                                            <input type="text" class="form-control" value="{{$nomphase[$project->phase]}}"  disabled/>

                                        </div>


                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6 class="mb-0"> Abreviation:</h6>


                                            <input type="text" class="form-control"  value="{{$project->abreviation}}" name="Abreviation"/>
                                            @if($errors->has('Abreviation'))
                                            <div><span style="color: red">Saisissez l'abreviation du projet</span></div>
                                            @endif
                                        </div>

                                        <div class="form-group" >
                                            <h6 class="mb-0">Structure Pilote:</h6>

                                            <div class="form-group col-md-4 " style="max-width: 100%">

                                                <select class="custom-select form-control "   name="StructurePilote" >
                                                    <option value={{ $project->structure_pilote }} selected>{{$project->structure_pilote}}</option>
                                                    @foreach ($dep as $d)

                                                    @if (  $project->structure_pilote!=$d->nomdep )
                                                    <option value={{$d->nomdep}}  >{{$d->nomdep}}</option>
                                                    @endif

                                                    @endforeach

                                                </select>
                                            </div>

                                        <div class="form-group">
                                            <h6 class="mb-0"> budget:</h6>

                                            <input type="number" class="form-control"value="{{$project->budget}}"  name="budget"/>
                                        </div>

                                        <div class="form-group ">




                                            {{-- Chef Projet: --}}
                                            <h6 class="mb-0"> Chef Projet:</h6>
                                            <div  type="text" id="chef"class="form-control"  name="ChefProjet"  ><a href="/users/{{$chef->id}}"><p>{{$chef->nom}} {{$chef->prenom}}</p></a> </div>

                                            <input type="hidden"  id="chefid" class="form-control " value="{{$chef->id}}"  name="Chefid" />


                                            <a data-toggle="modal" href="#myModal"  class="btn btn-warning btn-sm " style="margin: 10px">Choisir Chef Projet</a>
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Feremr</button>

                                                    </div>
                                                    </div>
                                                </div>
                                                </div>



                                        </div>

                                        <div class="form-group">
                                            {{-- Representant E&P --}}
                                            <h6 class="mb-0"> Representant E&P:</h6>


                                            <div   type="text"   id="RepresentantE&P"  class="form-control"  name="Representant E&P" placeholder="Representant E&P" > <a href="/users/{{$rep->id}}"><p>{{$rep->nom}} {{$rep->prenom}}</p></a> </div>
                                            <input type="hidden" id="RepresentantE&Pid"  class="form-control" name="RepresentantE&Pid"   value="{{$rep->id}}"  />




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

                                                <input type="hidden" id="equipeid"  class="form-control"  value="" name="equipeid[]"/>





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

                                                                                    <th scope="col">select</th>


                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    @foreach ($users as $user)

                                                                                    <tr id={{$user->id}}>

                                                                                    <th scope="row" style="text-align: center" class="rowdata"><a href="/users/{{$user->id}}}">{{$user->nom}} </a> </th>
                                                                                    <td style="text-align: center" class="rowdata">{{$user->prenom}}</td>
                                                                                    <td style="text-align: center" class="rowdata">{{$user->poste}} </td>

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




                                <div class="form-group" style="text-align: center">
                                    <a href="/fichier/{{$project->id}}/{{$nomphase[$project->phase]}}?var=edit">

                                        <button type="button" class="btn   btn-warning btn-lg " style="margin-top: 20px">
                                         <i class="fas fa-fw fa-archive"></i> Modifier fichier du projet
                                       </button>
                                          </a>
                                </div>



                                <div class="form-group">
                                    <label for="comment">Description:</label>
                                    <textarea class="form-control" rows="5"name="Description"  >{{$project->description}}</textarea>
                                    @if($errors->has('Description'))
                                    <div><span style="color: red">Saisissez la description du projet</span></div>
                                     @endif

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



                                </div>


                                    <br>
                                    <br>




                                <div class="butt">



                                <div class="son son1">
                                    <!-- Button trigger modal -->

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

                                var memberequipe = document.createElement('p')

                                var text = document.createTextNode(x);
                                memberequipe.appendChild(text);

                                var link = document.createElement('a')

                                link.href="/users/"+rowId;
                                link.appendChild(memberequipe)



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

                                var memberequipe = document.createElement('p')

                                var text = document.createTextNode(x);
                                memberequipe.appendChild(text);

                                var link = document.createElement('a')

                                link.href="/users/"+rowId;
                                link.appendChild(memberequipe)



                                daddy.appendChild(link);


                                document.getElementById("RepresentantE&Pid").value = rowId;
                                }

                                let a=[];
                                let b=[];


                                Array.prototype.push.apply(a,@json($equipe));
                                Array.prototype.push.apply(b,@json($ei));
                                let inc=0;
                                a.forEach(element => {

                                var memberequipedad = document.createElement('p');
                                var memberequipe = document.createElement('span');

                                var text = document.createTextNode(element);
                                memberequipe.appendChild(text);

                                var link = document.createElement('a')
                                link.href="/users/"+b[inc];
                                link.appendChild(memberequipe)
                                memberequipedad.appendChild(link);

                                var button = document.createElement('button');
                                        button.innerHTML = '&times;';
                                        button.classList.add("close");
                                        button.setAttribute('type','button');
                                        button.onclick = function(){

                                        var index = b.indexOf(b[inc]);
                                            if (index !== -1) {
                                                b.splice(index, 1);
                                                document.getElementById("equipeid").value=b;
                                            }
                                        button.parentNode.parentNode.removeChild(button.parentNode);

                                        };

                                memberequipedad.appendChild(button);
                                var daddy=document.getElementById("equipe")
                                daddy.appendChild(memberequipedad);



                                });


                                document.getElementById("equipeid").value =b;

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



                                var daddy=document.getElementById("equipe")

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



                                a=[];
                                b=[];
                                const myNode = document.getElementById("equipe");
                                myNode.innerHTML = '';

                                document.getElementById("equipe").value ='';

                                document.getElementById("equipeid").value ='';

                                }




                                </script>


                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection


