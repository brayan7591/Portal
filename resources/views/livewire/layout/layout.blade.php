<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar Perfil</title>
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
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
                    <a class="nav-link active">Actualizando perfil</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span id="nombreActual">{{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @can('Dashboard')
                                <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                            @endcan
                            <a class="dropdown-item active" href="{{route('perfil')}}">Configuracion</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Cerrar sesion</button>
                            </form>
                        </div>
                    </li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="bg-dark p-2">
        {{$slot}}
    </main>

    @livewireScripts
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('NuevoNombre', nombredado => {
            document.getElementById('nombreActual').innerText = nombredado;
            alert("Felicidades has actualizado tu usuario.");
        })

        Livewire.on('ContrasenaActualizada', () => {
            alert('Felicidades has actualizado la contraseña exitosamente');
        })

        Livewire.on('EliminarCuenta', () => {
            Swal.fire({
                title: "¿Estas seguro de eliminar tu usuario?",
                text: "Esta accion no se puede revertir! ",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('actualizar-usuario', 'deleteCuenta')

                        Swal.fire({
                            title: "Has eliminado tu usuario",
                            text: "Dentro de unos momentos seras redirigido",
                            icon: "success"
                        });
                    }
                });
        })
    </script>
</body>
</html>
