<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/principal.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <title>Portal</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg py-2" id="navbar-principal">
        <div class="container-fluid">
            <a class="navbar-brand d-flex gap-2 align-items" href="{{route('principal')}}">
                <img src="{{asset('favicons/favicon.ico')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">PortalWeb
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
              <li class="nav-item">
                    <a class="nav-link active" href="#inicio" aria-current="page">Inicio</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#programas">Programas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contactanos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ubicacion">Ubicacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('Iniciojuego')}}">Explora</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest
                    <li class="d-flex gap-2 justify-content-between nav-item">
                        @if (Route::has('login'))
                                <a class="btn btn-outline-dark" href="{{route('login')}}">Iniciar sesion</a>
                        @endif
                        @if (Route::has('register'))
                                <a class="btn btn-outline-dark" href="{{route('register')}}">Crear cuenta</a>
                        @endif
                        </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @can('Dashboard')
                                <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                            @endcan
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Cerrar sesion</button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
          </div>
        </div>
    </nav>
    <section class="min-vh-100 p-4" id="inicio">
        <h1 class="text-center">PORTAL INFORMATIVO DEL SENA CBA</h1>
        <h2>Inicio:</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus culpa vitae, error corporis illo nihil est illum debitis, earum delectus soluta asperiores facere numquam architecto at dolorem accusamus ipsam reiciendis.</p>
    </section>
    <section class="min-vh-100 bg-programas p-4" id="programas">
        <span class="text-center d-block h3">Conoce mas</span>
        <h1 class="text-center text-primary">OBTENDRAS MAS INFORMACIÓN ACERCA DE NUESTROS PROGRAMAS</h1>
        <div class="programas">
            @foreach ($Programas as $Programa)
                <div class="border border-dark rounded ajustar">
                    <h2 class="text-center">{{$Programa->NombrePrograma}}</h2>
                    <div class="imagen"><img src="{{Storage::url($Programa->imagen)}}" alt="imagen de {{$Programa->NombrePrograma}}"></div>
                    <p class="sobretexto">{{$Programa->Descripcion}}</p>
                    <div class="d-flex justify-content-center  align-items-center boton">
                        <a href="{{route('landingPage', $Programa->slug)}}" type="button" class="btn btn-primary text-center">Conoce más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="min-vh-100 bg-white p-4" id="contacto">
        <h1 class="text-center">Contactanos</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus culpa vitae, error corporis illo nihil est illum debitis, earum delectus soluta asperiores facere numquam architecto at dolorem accusamus ipsam reiciendis.</p>
    </section>
    <section class="min-vh-100 bg-gray p-4" id="ubicacion">
        <h1 class="text-center">Donde estamos ubicados:</h1>
        <div class="mapa" style="height:100vh">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4644.341978578333!2d-74.21820092438342!3d4.695709041699507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9d58cf6e291b%3A0x8946ec678fcf04b4!2sSENA%20Mosquera%20-%20Centro%20de%20Biotecnolog%C3%ADa%20Agropecuaria%20(CBA)!5e1!3m2!1ses-419!2sco!4v1716822480771!5m2!1ses-419!2sco" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
        </div>
    </section>
    <footer class="bg-dark text-white p-4">
        <p class="h1 m-0">Todos los derechos reservados Copyrigth &copy;</p>
    </footer>

    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>