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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stylemenu.css')}}" rel="stylesheet" >
    @yield('links')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    PortalWeb
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <article>
            <div class="fondo">
                <ul class="menu">
                    <div class="toggle"><i class="fa-solid fa-plus"></i></div>

                    <li class="proyectos" style="--i:0;--clr:#F5FF00" title="inicio">
                        <a href="{{route('landingPage')}}" {{request()->routeIs('landingPage') ? 'class=disabled' : ''}}><i class="fa-solid fa-house"></i></a>
                    </li>

                    <li class="proyectos" style="--i:1;--clr:#E2FF00" title="Curriculum">
                        <a href="#"><i class="fa-solid fa-address-card"></i></a>
                    </li>

                    <li class="proyectos" style="--i:2;--clr:#2BFF00" title="Instructores">
                        <a href="#"><i class="fa-solid fa-users"></i></a>
                    </li>

                    <li class="proyectos" style="--i:3;--clr:#00FFF3" title="Egresados">
                        <a href="#"><i class="fa-solid fa-user-plus"></i></a><
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
                        <a href="#"><i class="fa-sharp fa-solid fa-landmark"></i></a>
                    </li>

                    <li class="proyectos" style="--i:9;--clr:#FF0E43" title="Estadisticas">
                        <a href="#"><i class="fa-solid fa-chart-line"></i></a>
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

        <main>
            @yield('content')
        </main>
    </div>

    <script>
		let toggle = document.querySelector('.toggle');
		let menu = document.querySelector('.menu');
		toggle.onclick =function(){
			menu.classList.toggle('active');
		}
	</script>

</body>
</html>
