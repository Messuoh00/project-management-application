<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if(count($errors) >0)

@foreach($errors->all() as $error)
{{$error}}
@endforeach

@endif

<form method="post" action="/passwordupdate/" >
    {{csrf_field()}}
    {{ method_field('PATCH') }}
      

    <label >ancien mot de passe :</label><br>
    <input type="password" id="oldpassword" name="oldpassword" ><br><br>
    <label for="lname">nouveau mot de passe :</label><br>
  <input type="password"   id="newpassword" name="newpassword" ><br><br>
  

    

    <input type="submit" value="enregistrement">
    </form> 

    @if($message=Session::get('error'))
  {{Session::get('error')}}
  @endif


</body>
</html>