@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">historique des memebre retire  du projet <a href="/projet/{{$id}}">{{$id}}</a> :</h1>

                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">

                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true" style="width:100%" >



                                                        <thead>
                                                            <tr style="text-align: center">


                                                            <th scope="col" data-sortable="true">Nom</th>
                                                            <th scope="col" data-sortable="true">Prenom</th>
                                                            <th scope="col" data-sortable="true">Poste </th>
                                                            <th scope="col" data-sortable="true">Date </th>





                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach ($chefs as $chef)


                                                            <tr id={{$chef->id}} style='height:100px;cursor: pointer; cursor: hand;'   >

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$chef->id}}')">  {{$chef->nom}} </div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$chef->id}}')"> {{$chef->prenom}} </div> </td>


                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$chef->id}}')"> Chef Projet </div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$chef->id}}')"> {{$chef->updated_at}} </div> </td>

                                                            </tr>

                                                        @endforeach

                                                        @foreach ($reps as $rep)


                                                            <tr id={{$rep->id}} style='height:100px;cursor: pointer; cursor: hand;'   >




                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$rep->id}}')">  {{$rep->nom}} </div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$rep->id}}')"> {{$rep->prenom}} </div> </td>


                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$rep->id}}')"> Rep Ep</div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$rep->id}}')"> {{$rep->updated_at}} </div> </td>


                                                            </tr>

                                                        @endforeach

                                                        @foreach ($membres as $membre)


                                                            <tr id={{$membre->id}} style='height:100px;cursor: pointer; cursor: hand;'   >


                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$membre->id}}')">  {{$membre->nom}} </div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$membre->id}}')"> {{$membre->prenom}} </div> </td>


                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$membre->id}}')"> Membre equipe </div> </td>

                                                            <td style="text-align: center;"><div style="width:100%;padding:25px" onclick="link('/users/{{$membre->id}}')"> {{$membre->updated_at}} </div> </td>


                                                            </tr>

                                                        @endforeach

                                                        </tbody>

                                                        </table>









                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <script type="text/javascript">
                                function link(id)
                                           {
                                               location.href = id;
                                           }
                                  ;
                               </script>


@endsection

