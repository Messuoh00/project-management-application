@extends('layout.main')


@section('content')
<link href="{{asset('css/formulaire.css')}}" rel="stylesheet">
<div class="container">
 <h3> modification du mot de passe:</h3>
 
	<hr>
 
 
    <form method="post" action="/passwordupdate/" >
    {{csrf_field()}}
    {{ method_field('PATCH') }}
	
    <label  >veuillez introduire l'ancien mot de passe:</label>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fas fa-key"></i> </span>
		 </div>
        <input id="oldpassword" name="oldpassword" class="form-control" placeholder="ancien mot de passe " type="password">
    </div>
     <label  >veuillez introduire le nouveau mot de passe:</label>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fas fa-lock"></i> </span>
		 </div>

        <input  id="newpassword" name="newpassword" class="form-control" placeholder="nouveau mot de passe " type="password">
		
    </div>

   



    
  
    <button type="submit" class="btn btn-primary">Valider</button>

		   @if($message=Session::get('error'))
           {{Session::get('error')}}
             @endif
			 @if(count($errors) >0)

			@foreach($errors->all() as $error)
			{{$error}}
			@endforeach

			@endif
	</form> 
</div>



@endsection