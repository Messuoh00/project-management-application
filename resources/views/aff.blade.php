@extends('layout.main')

@section('content')
    

  @if(isset(Auth::user()->email))
  <h1>   {{Auth::user()->id}}     </h1>  
  <h1>   <a href="{{ url('/logout')}}"> se deconnecter </a>                   </h1>
  <h1>   <a href="{{ url('/users')}}"> liste des utilisateurs </a>                   </h1>
  <h1>   <a href="{{ url('/passwordedit')}}"> changer mot de passe </a>                   </h1>
  @else 

  <script> window.location="/login";      </script>
  @endif




@endsection
