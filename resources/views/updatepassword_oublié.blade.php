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
                    <h3 style="text-align:center">réinitialisation du mot de passe pour l'email</h3>
                    <br>
                    <h5 style="text-align:center;color:chocolate">{{$email}}</h5>
                    <div class="d-flex justify-content-end social_icon">
                        
                        
                        
                    </div>
                </div>
                <div class="card-body">
                @if(Session::get('success'))
                        <h6 style="color:greenyellow; margin-bottom:20px">
                        {{Session::get('success')}}
                        </h6>

                        
                        @endif
                    <h6 style="color:chocolate; margin-bottom:20px">
                        veuillez introduire le nouveau mot de passe
                    </h6>
                    <form method="post" action="{{url('/resetpasswordfinal')}}" >
                     {{csrf_field()}}
                     <input name="token" type="hidden" value="{{$token}}">
                     <input name="email" type="hidden" value="{{$email}}">
                                    <div class="input-data">
                            <input  id="newpassword" name="newpassword" type="password" required>
                            <div class="underline"></div>
                            <label>nouveau mot de passe</label>
                            </div>
                            @if($errors->has('newpassword'))
                             <div><span style="color: chocolate">veuillez introduire le nouveau mot de passe</span></div>
                              @endif
                           
                      
                    
                        <div style="margin-top:30px ;" class="input-data">
                        <input id="newpassword2" name="newpassword2" type="password" required>
                            <div class="underline"></div>
                            <label>confirmation du nouveau mot de passe</label>
                            </div>
                            @if($errors->has('newpassword2'))
                             <div><span style="color: chocolate">veuillez introduire la confirmation du nouveau mot de passe</span></div>
                             @endif
                             @if($message=Session::get('error'))
                                                                                                                                                     
                             <div><span style="color: chocolate">{{Session::get('error')}}</span></div>
                              @endif
                            
                        
                    
                        
                        
                        <div class="form-group">
                            <input type="submit" value="Réinitialiser"  class="btn float-right login_btn">
                        </div>
                        <hr>
                        
                       
                        
                    </form>
                    </div>
					

                </div>
               
            </div>
        </div>
    </div>
</body>
</html>