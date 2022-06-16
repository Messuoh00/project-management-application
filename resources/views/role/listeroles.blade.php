@extends('layout.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Liste des roles </h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                @if($message=Session::get('erreursup'))
                                                                                    
                                                                                    
                                                                                        
                                                                                    <div><span style="color: red">{{Session::get('erreursup')}}</span></div>
                                                                                            @endif
                                                @if($errors->has('nom_role'))
                                                                                                                        <div><span style="color: red">{{$errors->first('nom_role')}}</span></div>
                                                                                                                                @endif
                                                             <button class="btn btn-warning" data-toggle="modal" href="#myModal">ajouter un nouveau role</button>  
                                                             <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                                                                                                        <div class="modal-dialog" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                            <div class="modal-header">
                                                                                                                                <h5 class="modal-title">ajouter un role</h5>
                                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                                                </button>
                                                                                                                            </div>
                                                                                                                            <div class="modal-body">
                                                                                                                            <h6 class="mb-0"> nom du role :</h6>
                                                                                                                            <form method="post" action="{{url('/roles')}}"  >
                                                                                                                                
                                                                                                                                {{csrf_field()}}
                                                                                                                            <input style=" margin-top:10px;border-radius:1.5rem;" type="text" class="form-control" placeholder="nom du role" name="nom_role"/>

                                                                                                                            
                                                                                                                            <input class="btn btn-warning" style="margin-top:10px; width:100px; " type="submit" value="ajouter">
                                                                                                                            </form> 
                                                                                                                                
                                                                                                                                

                                                                                                                                                                                                                                       

                                                                                                                            </div>
                                                                                                                            <div class="modal-footer">
                                                                                                                                <button type="button" class="btn btn-secondary"data-dismiss="modal" >Fermer</button>

                                                                                                                            </div>
                                                                                                                         </div>
                                                                                                             </div> 
                                                             </div> 
                                                 
                                                             

                                                            

                                                        <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                        <thead>
                                                                <tr>
                                                                 <th scope="col" data-sortable="true">nom du role </th>  
                                                                 <th scope="col" data-sortable="true">date de creation</th>
                                                                 <th scope="col" data-sortable="true">supprimer</th>
         
                                                                
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                             
                                                            @foreach($roles as $role)
                                                            <tr>
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer"  onclick="link('/roles/{{$role->id}}/edit')" > {{$role->nom_role}} </div></td>
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer"  onclick="link('/roles/{{$role->id}}/edit')" > {{$role->created_at}} </div></td>
                                                            <td > <div    > <form id="form{{$role->id}}" action="/roles/{{$role->id}}" method="POST">
                                                                                            @csrf
                                                                                            @method('delete') </form>
                                                                <button class="btn btn-danger" onclick="supprimerrole({{$role->id}})" > supprimer </a>  </div></td>

                                                            
                                                            

                                                            <!-- Modal -->
                      
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

 <script type="text/javascript" >
     function supprimerrole(id){
         if(confirm('etes vous sur de vouloir supprimer ce role?')==true){
         form=document.getElementById('form'+id);
         form.submit();}
         else{
             
         }

     }
 function link(url)
 {
     
    location.href = url;
 }
   
</script>



@endsection