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
    <link href="{{asset('/css/resetpassword.css')}}" rel="stylesheet" type=>
</head>
<body>
@if(isset(Auth::user()->email))
<script> window.location="/coo-E&P";      </script>
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
                @if(Session::get('success_reset'))
                        <h6 style="color:greenyellow; margin-bottom:20px">
                        {{Session::get('success_reset')}}
                        </h6>
                        @endif
                    <form method="post" autocomplete="off" action="{{url('/login')}}" >
                     {{csrf_field()}}
                     <div class="input-data">
                            <input type="text" id="email" name="email" required>
                            <div class="underline"></div>
                            <label>adresse email</label>
                        </div>
                        @if($errors->has('email'))
                             <div><span style="color: chocolate">{{$errors->first('email')}}</span></div>
                                     @endif
                                     <div style="margin-top:30px ;" class="input-data">
                            <input type="password" id="password" name="password" required>
                            <div class="underline"></div>
                            <label>mot de passe</label>
                        </div>
                        @if($errors->has('password'))
                             <div><span style="color: chocolate">veuillez introduire le mot de passe</span></div>
                                     @endif
                                     @if($message=Session::get('error'))
                                     <div><span style="color: chocolate">{{Session::get('error')}}</span></div>
						  @endif

                                 <div style="margin-top:10px ;" class="form-check">
                                <input class="form-check-input" name="sesouvenir" type="checkbox" id="flexCheckDefault">
                                <label style="color:white" class="form-check-label" for="flexCheckDefault">
                                    Se souvenir de moi
                                </label>
                                </div>
                        
                        <div class="form-group">
                            <input type="submit" style="border-radius:50px;" value="se connecter" class="btn float-right login_btn">
                        </div>
                        <hr>
                    </form>
                    <h6 style="color:white ;"> mot de passe oublié?  <a class="réinitialiser-a" href="/resetpassword"> réinitialiser le mot de passe</a>
                           
                        </h6>
					

                </div>
               
            </div>
        </div>
    </div>
</body>
</html>