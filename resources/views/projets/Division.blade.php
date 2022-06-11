@extends('layout.main')


@section('styles')




@endsection





@section('content')

                            <!-- Page Heading -->


                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Gestion des divisions:</h1>
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

                                                        </thead>

                                                        <tbody >

                                                            @foreach ($dep as $d)
                                                            <tr >
                                                                    <td>

                                                                        <form action="/Division/{{$d->id}}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('put')

                                                                            <div style="float: left">
                                                                              <input type="text" value="{{$d->nomdep}}"  class="form-control" name='namedep'>

                                                                               <button type="button submit" hidden></button>

                                                                            </div>

                                                                           </form>


                                                                        <div style="float: right">
                                                                            <form action="/Division/{{$d->id}}" method="POST">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="button submit" class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir supprimer cette Division?');">supprime</button>
                                                                            </form>


                                                                        </div>

                                                                    </td>

                                                            </tr>
                                                            @endforeach
                                                        </tbody>

                                                    </table>



                                                    <form action="{{route('Division.store')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                     <a data-toggle="modal" href="#myModal3"  class="btn btn-warning btn-sm " style="margin: 10px">Ajouter Division</a>
                                                    <div class="modal" tabindex="-1" role="dialog" id="myModal3">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <b>Nom de la nouvelle Division:</b>
                                                                <input type="text" class="form-control"  required='required' placeholder="NomDep" name="nomdep"/>
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

