<!DOCTYPE html>
<html lang="en">
<head>
  <title>HerbaMonstrum</title>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/r-2.2.9/sc-2.0.5/sb-1.3.2/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css"/>



  <style>
    .card{
      margin: 5px;
    }
  </style>
 </head>
<body>

  @if(isset(Auth::user()->email))
 <!--
  <div class="alert alert-success success-block">
  <strong>Welcome {{ Auth::user()->name }}</strong>
  <br />
  <a href="{{ url('/logout') }}">Logout</a>
 </div> -->
@else
 <script>window.location = "/main";</script>
@endif

<div class="container box">
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            <img src="{{asset('/img/logo.png')}}" alt="logo" alt="" width="50" height="50">

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> Gestione prenotazioni
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/nuovaPrenotazione">Nuova Prenotazione</a></li>
                        <li><a class="dropdown-item" href="/prenotazioni">Visualizza Prenotazioni</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Statistiche Prenotazioni</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div sec:authorize="hasAnyAuthority('ROLE_ADMIN')">
                        <a class="nav-link " href="/adminTools">Admin tools</a>
                    </div>

                </li>
                <li class="nav-item">

                        <a class="nav-link " href="/logout">LOGOUT</a>


                </li>
            </ul>
            <!--
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            -->
        </div>
    </div>
</nav>
@yield('content')
    
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/r-2.2.9/sc-2.0.5/sb-1.3.2/datatables.min.js"></script>
 @yield('js')
  </body>
</html>