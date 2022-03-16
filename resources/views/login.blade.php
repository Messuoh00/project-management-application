<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="{{asset('/css/login.css')}}" rel="stylesheet" type=>
</head>
<body>
@if(isset(Auth::user()->email))
<script> window.location="/apreslogin";      </script>
@endif
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Authentification</h3>
                    <div class="d-flex justify-content-end social_icon">
                        
                        
                        <span><img class="logo"src="img/logosonatrach.png" alt=""></span>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{url('/login')}}" >
                     {{csrf_field()}}
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" id="email" name="email" class="form-control" placeholder="adresse email">
                            
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="mot de passe">
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" value="se connecter" class="btn float-right login_btn">
                        </div>
                        <hr>
                    </form>
					
						@if(count($errors) >0)

						@foreach($errors->all() as $error)
						{{$error}}
						@endforeach
                         @endif
						   @if($message=Session::get('error'))
						  {{Session::get('error')}}
						  @endif

                </div>
               
            </div>
        </div>
    </div>
</body>
</html>