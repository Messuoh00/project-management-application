<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  @if(isset(Auth::user()->email))
  <h1>   {{Auth::user()->id}}     </h1>  
  <h1>   <a href="{{ url('/logout')}}"> se deconnecter </a>                   </h1>
  <h1>   <a href="{{ url('/users')}}"> liste des utilisateurs </a>                   </h1>
  <h1>   <a href="{{ url('/passwordedit')}}"> changer mot de passe </a>                   </h1>
  @else 

  <script> window.location="/login";      </script>
  @endif
</body>
</html>