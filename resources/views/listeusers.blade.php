@extends('layout.main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

@section('styles')




@endsection





@section('content')







                            <!-- Page Heading -->

  
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">Liste des utilisateurs </h1>
                               
                            </div>

                            <!-- Content Row -->
                            <div class="row">

                                <!-- Pending Requests Card Example -->
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col ">
                                                   
                                                                                           
                                                        <table class="table table-sm " data-toggle="table" data-search="true"  data-show-columns="true" data-pagination="true"  >
                                                            

                                                        <thead>
                                                                <tr>
                                                                 <th scope="col" data-sortable="true">nom</th>  
                                                                 <th scope="col" data-sortable="true">prenom</th>
                                                                 <th scope="col" data-sortable="true">email</th>
                                                                 <th scope="col" data-sortable="true">role</th>
                                                                 <th scope="col" data-sortable="true">divsion</th>
                                                                 <th scope="col" >modifier</th>
                                                                 <th scope="col" >supprimer</th>

                                                            
                                                                
                                                                
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            
                                                            @foreach($users as $user)
                                                            <tr> 
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer"  onclick="link('/users/{{$user->id}}')" > {{$user->nom}} </div></td>
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer"  onclick="link('/users/{{$user->id}}')" > {{$user->prenom}} </div></td>
                                                            <td > <div style="width:100%;padding:25px ;cursor:pointer" onclick="link('/users/{{$user->id}}')" > {{$user->email}} </div></td>
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer" onclick="link('/users/{{$user->id}}')" > {{$user->role->nom_role}}  </div></td>
                                                            <td > <div style="width:100%;padding:25px;cursor:pointer" onclick="link('/users/{{$user->id}}')" > {{$user->division->nomdep}}  </div> </td>
                                                            <td> <a class="btn btn-warning" href="/users/{{$user->id}}/edit">modifier</a>  </td>
                                                            <td> <a class="btn btn-danger" href="/users/{{$user->id}}/edit">supprimer</a>  </td>

                                                            

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
 function link(url)
 {
     
    location.href = url;
 }
   
</script>



@endsection