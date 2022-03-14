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
<script> window.location="/apreslogin";      </script>
@endif
  @if($message=Session::get('error'))
  {{Session::get('error')}}
  @endif
<form method="post" action="{{url('/login')}}" >
    {{csrf_field()}}
  <label for="fname">email:</label><br>
  <input type="email" id="email" name="email" ><br>
  <label for="lname">password:</label><br>
 
  <input type="password" id="password" name="password" ><br><br>
  <input type="submit" value="Submit">
</form> 
@if(count($errors) >0)

@foreach($errors->all() as $error)
{{$error}}
@endforeach

@endif

</body>
</html>