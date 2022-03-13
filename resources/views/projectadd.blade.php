@extends('layout.main')

@section('styles')
<link href="{{ asset('css/projectadd.css') }}" rel="stylesheet" type="text/css"  >
@endsection


@section('content')



    <div class="form">
        <div class="note">
          <h1>Ajouter un Projet</h1>
        </div>

        <div class="form-content">
            <form action="{{route('projet.store')}}" method="POST">
                @csrf
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <h6 class="mb-0">Nom Projet:</h6>

                        <input type="text" class="form-control" placeholder="Nom Projet" name="Nom Projet"/>
                    </div>
                    
                    <div class="form-group">
                        <h6 class="mb-0"> Thematique:</h6>

                        <input type="text" class="form-control" placeholder="Thematique" name="Thematique"/>
                    </div>


                    <div class="form-group">
                        <h6 class="mb-0"> Region Test:</h6>

                        <input type="text" class="form-control" placeholder="Region Test" name="Region Test"/>
                    </div>

                    <div class="form-group">
                        <h6 class="mb-0"> Date Debut:</h6>

                        <input type="text" class="form-control" placeholder="Date Debut" name="Date Debut"/>
                    </div>

                   
                    <div class="form-group">
                        <h6 class="mb-0"> Date Fin:</h6>

                        <input type="text" class="form-control" placeholder="Date Fin" name="Date Fin"/>
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
                          
                            <select class="custom-select form-control "   name="Structure Pilote" >
                                <option selected value="0">Zero</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                              </select>
                        </div>

                    <div class="form-group">
                        <h6 class="mb-0"> budget:</h6>

                        <input type="text" class="form-control" placeholder="budget" name="budget"/>
                    </div>

                    <div class="form-group ">
                        <h6 class="mb-0"> Chef Projet:</h6>

                        <input type="text" class="form-control " placeholder="Chef Projet" name="Chef Projet"/>
                    </div>

                    <div class="form-group">
                        <h6 class="mb-0"> Representant E&P:</h6>

                        <input type="text" class="form-control" placeholder="Representant E&P" name="Representant E&P"/>
                    </div>

                    <div class="form-group">
                        <h6 class="mb-0"> Equipe:</h6>

                        <input type="text" class="form-control" placeholder="Equipe" name="Equipe"/>
                    </div>


                </div>
            </div>

            <div class="form-group">
                <label for="comment">Description:</label>
                <textarea class="form-control" rows="5"name="Description"></textarea>
              </div>

            <button type="submit" class="btnSubmit">Submit</button>
            </form>
        </div>
 
    </div>



@endsection


    
@section('java')

  


@endsection