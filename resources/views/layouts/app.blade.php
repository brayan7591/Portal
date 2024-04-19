<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'titulo')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/localstorage.js') }}"></script>

    @yield('Scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylemenu.css')}}" rel="stylesheet" >
    @yield('links')
</head>
<body class="bg-dark text-white">
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-dark py-2" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex gap-2 align-items" href="{{route('principal')}}">
                    <img src="{{Storage::url('imagenes/logo.png')}}" alt="Logo" width="30" height="24" class="d-inline-block bg-white align-text-top">PortalWeb
                </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                   <li class="nav-item">
                        @if (request()->routeIs('landingPage'))
                            <a class="nav-link active disabled" aria-current="page">Inicio</a>
                        @else
                            <a class="nav-link" aria-current="page" href="{{route('landingPage', compact('programa'))}}">Inicio</a>
                        @endif
                    </li>
                    @if ($programa->niveles->count() > 0)
                        <li class="nav-item dropdown">
                            <button class="nav-link {{request()->routeIs('curriculum') ? 'active' : ''}} dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Curriculum</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($programa->niveles as $posicion => $nivel)
                                    <li><a class="dropdown-item {{request()->routeIs('curriculum') ? ($nivelaceptado->nivel == $nivel->nivel ? 'active' : '') : ''}}" href="{{route('curriculum', [$programa->slug, $nivel->nivel])}}"> {{$nivel->nivel}} </a></li>
                                    @if (!($posicion + 1 == $programa->niveles->count()))
                                        <li><hr class="dropdown-divider"></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('biblioteca') ? 'active disabled' : ''}}" href="{{route('biblioteca', $programa->slug)}}">Biblioteca</a>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="nav-link {{request()->routeIs('instructores') ? 'active' : ''}} dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Apartados</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <li>
                                @if (request()->routeIs('instructores'))
                                    <a class="dropdown-item active">Instructores</a>
                                @else
                                    <a class="dropdown-item" href="{{route('instructores', $programa->slug)}}">Instructores</a>
                                @endif
                            </li>

                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Egresados</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Aprendices</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Voceros</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Competencias</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ocultar menu</label>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
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
                    @else
                        <a class="btn btn-outline-white border-white" href="{{route('principal')}}">Volver a la pagina principal</a>
                    @endauth
                    </ul>
              </div>
            </div>
        </nav>

        <article id="background-image">
            <div class="fondo">
                <img src="{{$programa->imagen}}" alt="Imagen de {{$programa->NombrePrograma}}">
                <ul class="menu">
                    <div class="toggle"><i class="fa-solid fa-plus"></i></div>

                    <li class="proyectos" style="--i:0;--clr:#F5FF00" title="inicio">
                        <a href="{{route('landingPage', compact('programa'))}}" {{request()->routeIs('landingPage') ? 'class=disabled' : ''}}><i class="fa-solid fa-house"></i></a>
                    </li>
                    
                    <li class="proyectos" style="--i:1;--clr:#E2FF00" title="Curriculum">
                        <a href="#"><i class="fa-solid fa-address-card"></i></a>
                    </li>

                    <li class="proyectos" style="--i:2;--clr:#2BFF00" title="Instructores">
                        <a href="{{route('instructores', $programa->slug)}}" {{request()->routeIs('instructores') ? 'class=disabled' : ''}}><i class="fa-solid fa-users"></i></a>
                    </li>

                    <li class="proyectos" style="--i:3;--clr:#00FFF3" title="Egresados">
                        <a href="#"><i class="fa-solid fa-user-plus"></i></a>
                    </li>

                    <li class="proyectos" style="--i:4;--clr:#00FFF3" title="Eventos y Galerias">
                        <a href="#"><i class="fa-solid fa-calendar-days"></i></a>
                    </li>

                    <li class="proyectos" style="--i:5;--clr:#00C1FC" title="Reglamento">
                        <a href="#"><i class="fa-solid fa-book"></i></a>
                    </li>

                    <li class="proyectos" style="--i:6;--clr:#fff" title="Aprendices">
                        <a href="#"><i class="fa-solid fa-medal"></i></a>
                    </li>

                    <li class="proyectos" style="--i:7;--clr:#ffff00" title="Proyectos">
                        <a href="#"><i class="fa-solid fa-diagram-project"></i></a>
                    </li>

                    <li class="proyectos" style="--i:8;--clr:#ccc" title="Biblioteca">
                        <a href="{{route('biblioteca', $programa->slug)}}" {{request()->routeIs('biblioteca') ? 'class=disabled' : ''}}><i class="fa-sharp fa-solid fa-landmark"></i></a>
                    </li>

                    <li class="proyectos" style="--i:9;--clr:#FF0E43" title="Estadisticas">
                        <a href=""><i class="fa-solid fa-chart-line"></i></a>
                    </li>

                    <li class="proyectos" style="--i:10;--clr:#FF6961" title="Voceros">
                        <a href="#"><i class="fa-solid fa-user-tie"></i></a>
                    </li>

                    <li class="proyectos" style="--i:11;--clr:#FB00FC" title="Competencias">
                        <a href="#"><i class="fa-regular fa-circle-check"></i></a>
                    </li>
                </ul>
            </div>
        </article>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
		let toggle = document.querySelector('.toggle');
		let menu = document.querySelector('.menu');
		toggle.onclick = function(){
			menu.classList.toggle('active');
		}

        function cerrarsesion(){
            document.getElementById('logout-form').submit();
        }
	</script>

</body>
</html>
