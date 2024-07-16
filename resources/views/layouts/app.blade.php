<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'portal web')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('Scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css')}}" rel="stylesheet" >
    @yield('links')
</head>
<body class="bg-dark text-white {{ $menuAbierto == false ? '' : 'menuhidden'}}">
    <nav class="navbar navbar-expand-lg bg-black py-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex gap-2 align-items" href="{{route('principal')}}">
                <img src="{{asset('logos/logo-verde.png')}}" alt="Logo del portal web" width="30" height="24" class="d-inline-block align-text-top">PortalWeb
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
                                <li><a class="dropdown-item {{request()->routeIs('curriculum') ? ($nivelaceptado->SlugInterno == $nivel->SlugInterno ? 'active' : '') : ''}}" href="{{route('curriculum', [$programa->slug, $nivel->SlugInterno])}}"> {{$nivel->SlugInterno}} </a></li>
                                @if (!($posicion + 1 == $programa->niveles->count()))
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('eventos') ? 'active disabled' : ''}}" href="{{route('eventos', $programa->slug)}}">Eventos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('proyectos') ? 'active disabled' : ''}}" href="{{route('proyectos', $programa->slug)}}">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('biblioteca') ? 'active disabled' : ''}}" href="{{route('biblioteca', $programa->slug)}}">Biblioteca</a>
                </li>
                <li class="nav-item dropdown">
                    <button class="nav-link {{request()->routeIs('instructores') || request()->routeIs('egresados') || request()->routeIs('aprendices') || request()->routeIs('voceros') ? 'active' : ''}} dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Apartados</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <li>
                            @if (request()->routeIs('instructores'))
                                <a class="dropdown-item active">Instructores</a>
                            @else
                                <a class="dropdown-item" href="{{route('instructores', $programa->slug)}}">Instructores</a>
                            @endif
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            @if (request()->routeIs('egresados'))
                                <a class="dropdown-item active">Egresados</a>
                            @else
                                <a class="dropdown-item" href="{{route('egresados', $programa->slug)}}">Egresados</a>
                            @endif
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            @if (request()->routeIs('aprendices'))
                                <a class="dropdown-item active">Aprendices</a>
                            @else
                                <a class="dropdown-item" href="{{route('aprendices', $programa->slug)}}">Aprendices</a>
                            @endif
                        </li>

                        <li><hr class="dropdown-divider"></li>
                        
                        <li>
                            @if (request()->routeIs('voceros'))
                                <a class="dropdown-item active">Voceros</a>
                            @else
                                <a class="dropdown-item" href="{{route('voceros', $programa->slug)}}">Voceros</a>
                            @endif
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $menuAbierto == false ? '' : 'checked'}}>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Ocultar menu</label>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @guest
                    <li class="d-flex gap-2 justify-content-between nav-item">
                        @if (Route::has('login'))
                                <a class="btn btn-outline-light" href="{{route('login')}}">Iniciar sesion</a>
                        @endif
                        @if (Route::has('register'))
                                <a class="btn btn-outline-light" href="{{route('register')}}">Crear cuenta</a>
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

    <article id="background-image">
        <div class="fondo">
            <img src="{{asset('imagenes/programas/ADSO.png')}}" alt="Imagen de {{$programa->NombrePrograma}}">
            <ul class="menu">
                <div class="toggle"><i class="fa-solid fa-plus"></i></div>

                <li class="proyectos" style="--i:0;--clr:#F5FF00" title="inicio">
                    <a href="{{route('landingPage', compact('programa'))}}" {{request()->routeIs('landingPage') ? 'class=disabled' : ''}}> <span>Inicio</span><i class="fa-solid fa-house"></i></a>
                </li>
                
                <li class="proyectos" style="--i:1;--clr:#00FFF3" title="Eventos y Galerias">
                    <a href="{{route('eventos', compact('programa'))}}" {{request()->routeIs('eventos') ? 'class=disabled' : ''}}><span>Eventos</span><i class="fa-solid fa-calendar-days"></i></a>
                </li>

                <li class="proyectos" style="--i:2;--clr:#ffff00" title="Proyectos">
                    <a href="{{route('proyectos', compact('programa'))}}" {{request()->routeIs('proyectos') ? 'class=disabled' : ''}}><span>Proyectos</span><i class="fa-solid fa-diagram-project"></i></a>
                </li>

                <li class="proyectos" style="--i:3;--clr:#ccc" title="Biblioteca">
                    <a href="{{route('biblioteca', $programa->slug)}}" {{request()->routeIs('biblioteca') ? 'class=disabled' : ''}}><span>Biblioteca</span><i class="fa-sharp fa-solid fa-landmark"></i></a>
                </li>

                <li class="proyectos" style="--i:4;--clr:#2BFF00" title="Instructores">
                    <a href="{{route('instructores', $programa->slug)}}" {{request()->routeIs('instructores') ? 'class=disabled' : ''}}><span>Instructores</span><i class="fa-solid fa-users"></i></a>
                </li>

                <li class="proyectos" style="--i:5;--clr:#00FFF3" title="Egresados">
                    <a href="{{route('egresados', compact('programa'))}}" {{request()->routeIs('egresados') ? 'class=disabled' : ''}}><span>Egresados</span><i class="fa-solid fa-user-plus"></i></a>
                </li>

                <li class="proyectos" style="--i:6;--clr:#fff" title="Aprendices">
                    <a href="{{route('aprendices', compact('programa'))}}" {{request()->routeIs('aprendices') ? 'class=disabled' : ''}}><span>Aprendices</span><i class="fa-solid fa-medal"></i></a>
                </li>

                <li class="proyectos" style="--i:7;--clr:#FF6961" title="Voceros">
                    <a href="{{route('voceros', $programa->slug)}}" {{request()->routeIs('voceros') ? 'class=disabled' : ''}}><span>Voceros</span><i class="fa-solid fa-user-tie"></i></a>
                </li>
            </ul>
        </div>
    </article>

    <main class="py-2 min-vh-100">
        @yield('content')
    </main>
    <footer class="bg-black text-white p-4">
        <p class="h1 m-0">Todos los derechos reservados Copyrigth &copy;</p>
    </footer>
    <script>
		let toggle = document.querySelector('.toggle');
		let menu = document.querySelector('.menu');
		toggle.onclick = function(){
			menu.classList.toggle('active');
		}
        
        let checkear = document.getElementById('flexSwitchCheckChecked');
        checkear.addEventListener('click', function(){
            if (checkear.checked) {
                document.body.classList.add("menuhidden");
                fetch('{{route("actualizar-menu")}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ nuevoValor: true })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cambiar el valor');
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }else{
                document.body.classList.remove("menuhidden");
                fetch('{{route("actualizar-menu")}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ nuevoValor: false })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al cambiar el valor');
                    }
                    return response.json();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        })

	</script>

</body>
</html>
