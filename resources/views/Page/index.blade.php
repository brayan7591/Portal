<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/principal.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.icon') }}" type="image/x-icon">
    <title>Portal</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg py-2" id="navbar-principal">
        <div class="container-fluid">
            <a class="navbar-brand d-flex gap-2 align-items" href="{{route('principal')}}">
                <img src="{{Storage::url('imagenes/logo.png')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">PortalWeb
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
                            @can('dashboard')
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
    <section class="min-vh-100 bg-red" id="inicio">
        <h1 class="text-center">PORTAL INFORMATIVO DEL SENA CBA</h1>
        <h2>Inicio:</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus culpa vitae, error corporis illo nihil est illum debitis, earum delectus soluta asperiores facere numquam architecto at dolorem accusamus ipsam reiciendis.</p>
    </section>
    <section class="bg-gray" id="programas">
        <span class="text-center d-block h3">Conoce mas</span>
        <h1 class="text-center text-primary">OBTENDRAS MAS INFORMACIÓN ACERCA DE NUESTROS PROGRAMAS</h1>
        <div class="programas">
            @foreach ($Programas as $Programa)
                <div class="border border-dark rounded ajustar">
                    <h2 class="text-center">{{$Programa->NombrePrograma}}</h2>
                    <div class="imagen"><img src="{{$Programa->imagen}}" alt="imagen de {{$Programa->NombrePrograma}}"></div>
                    <p class="sobretexto">{{$Programa->Descripcion}}</p>
                    <div class="d-flex justify-content-center  align-items-center boton">
                        <a href="{{route('landingPage', $Programa->slug)}}" type="button" class="btn btn-primary text-center">Conoce más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="min-vh-100 bg-white" id="contacto">
        <h1 class="text-center">Contactanos</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus culpa vitae, error corporis illo nihil est illum debitis, earum delectus soluta asperiores facere numquam architecto at dolorem accusamus ipsam reiciendis.</p>
    </section>
    <footer class="bg-dark text-white p-4">
        <p class="h1 m-0">Todos los derechos reservados Copyrigth &copy;</p>
    </footer>

    <script src="{{asset('js/index.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>