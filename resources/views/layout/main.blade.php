<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Houssem</title>
    {{-- boottable --}} 
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">


  {{-- css for main --}} 
  <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css"  >
  
  @yield('styles')

</head>
<body>

  
  {{-- navbar here --}}
  <nav class="navbar navbar-expand-lg navbar-light " style="margin-bottom: -20px">
    <div class="container-fluid">
      <a class="navbar-brand logosona" href="/index" ><img src="{{url('/img/logo.png')}}" alt="Sonatrach"  img height="70" /></a> 
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index">Coordination E&P</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/projet">Tous les projets</a>
          </li>

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Phase avant projet et planification
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/projet?phase=1.1">Idee RD</a></li>
             
              <li><hr class="dropdown-divider"></li>

              <li><a class="dropdown-item" href="/projet?phase=1.2">Maturation</a></li>
            </ul>
          </li>

        
          <li class="nav-item dropdown  ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Phase exécution et suivi évaluation
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/projet?phase=2.1">Recherche </a></li>
              
              <li><hr class="dropdown-divider"></li>

              <li><a class="dropdown-item" href="/projet?phase=2.2">Test Pilote</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/projet?phase=3.1"> Phase  clôture et valorisation </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/stat">Satistiques</a>
          </li>


          <li class="nav-item dropdown usermenu">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{{url('/img/user.png')}}" height="25px" alt=""> 
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/connaisance">mes connaissance</a></li>
              
              <li><hr class="dropdown-divider"></li>

              <li><a class="dropdown-item" href="#">log out ></a></li>
            </ul>
          </li>



        </ul>
        
      </div>
    </div>
  </nav>

  {{-- navbarscript --}} 
  <script src="{{ asset('js/main.js') }}"></script>

      {{-- content here --}}

 
      <div class="content">
      
        @yield('content')
            
      </div>

  
    {{-- scripts --}}
    


  {{-- bootstrapjs --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/locale/bootstrap-table-fr-FR.min.js"></script>

  @yield('java')
</body>
</html>