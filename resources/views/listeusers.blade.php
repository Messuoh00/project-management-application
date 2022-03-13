<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<a class="btn btn-info" href="/users/create">creer</a>
<table class="table table-dark table-striped">
        <thead>
            <tr>
             <th scope="col">nom</th>  
             <th scope="col">prenom</th>
             <th scope="col">email</th>
             <th scope="col">poste</th>
             <th scope="col">divsion</th>
             <th scope="col">modifier</th>
           
             
             
            </tr>
        </thead>
    <tbody>
        <tr>
         @foreach($users as $user)
          <td>{{$user->nom}}</td>
          <td>{{$user->prenom}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->poste}} </td>
          <td>{{$user->division}} </td>
          <td> <a class="btn btn-info" href="/users/{{$user->id}}/edit">update</a>  </td>

        
        </tr>
        @endforeach
    </tbody>
    </table>
</body>
</html>