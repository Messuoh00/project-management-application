<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   

<form method="post" action="/users/{{$user->id}}/" >
    {{csrf_field()}}
    {{ method_field('PUT') }}
    <label for="fnom">nom:</label><br>
  <input type="text" id="nom" name="nom" value=" {{ $user->nom}}"><br>
  <label for="fprenom">prenom:</label><br>
  <input type="text" id="prenom" name="prenom" value=" {{ $user->prenom}}">
  <label for="femail">email:</label><br>
  <input type="email" id="email" name="email" value=" {{ $user->email}}" ><br>
  
  




    <label for="select1">choix poste:</label>
<select name="poste" id="poste" >
<option value="{{ $user->poste}}" selected  hidden>{{ $user->poste}}</option>
    
    <option value="vice president">vice president</option>
    <option value="manager">manager</option>
    <option value="employé">employé</option>
    </select>
    <label for="select2">choix division:</label>

    <select name="division" id="division">
    <option value="{{ $user->division}}" selected  hidden>{{ $user->division}}</option>
    <option value="ep">ep</option>
    <option value="ped">ped</option>
    <option value="exp">exp</option>
    <option value="dp">dp</option>
    <option value="ast">ast</option>
    <option value="for">for</option>
    </select>
    <input type="submit" value="enregistrement">
    </form> 
    @if(count($errors) >0)

@foreach($errors->all() as $error)
{{$error}}
@endforeach

@endif
</body>
</html>