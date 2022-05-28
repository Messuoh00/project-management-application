@extends('layout.main')


@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Phase</h1>

                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">



                                                    <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >

                                                        <thead>
                                                            <th></th>
                                                            <th></th>

                                                        </thead>

                                                        <tbody >
                                                            @php
                                                                $num=$ph->count();
                                                            @endphp

                                                            @foreach ($ph as $p)
                                                            <tr >
                                                                    <td style="text-align: center"> <b>{{$p->position}} </b></td>
                                                                    <td>


                                                                        <form action="/Phase/{{$p->id}}" method="POST" enctype="multipart/form-data">
                                                                         @csrf
                                                                         @method('put')

                                                                         <div style="float: left">
                                                                           <input type="text" value="{{$p->name}}"   class="form-control" name='namephasemod'>

                                                                            <button type="button submit" hidden></button>

                                                                         </div>

                                                                        </form>

                                                                        <div style="float: right">
                                                                            <form action="/Phase/{{$p->id}}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <input type="number" value="{{$p->position}}" name='pos' hidden >
                                                                                <button type="button submit" class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir d\'eactive  cette phase?');">supprime</button>
                                                                            </form>


                                                                        </div>



                                                                    </td>



                                                            </tr>


                                                            @endforeach
                                                        </tbody>

                                                    </table>



                                                    <form action="{{route('Phase.store')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                     <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px">Ajouter Phase</a>
                                                    <div class="modal" tabindex="-1" role="dialog" id="myModal3">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title">Phase</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <b>Numero de la phase:</b>
                                                              @php
                                                                  $i=-1;
                                                              @endphp
                                                                <select class="custom-select form-control "   name="idphase" >

                                                                    @for ($i = 0; $i <= $num; $i++)


                                                                    <option value={{$i}} selected>{{$i}}</option>

                                                                    @endfor


                                                                  </select>

                                                                <b>Nom de la phase:</b>
                                                                <input type="text" class="form-control" required='required'  name="namephase"/>
                                                            </div>

                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Fermer</button>
                                                            <button type="button submit" class="btn btn-warning">Confirmer</button>

                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>



                                                    </form>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





@endsection

