<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
    <title>Portal</title>
</head>
<body class="container">
    <section class="bg-gray">
        <span class="text-center d-block h3">Conoce mas</span>
        <h1 class="text-center text-primary">OBTENDRAS MAS INFORMACIÓN ACERCA DE NUESTROS PROGRAMAS</h1>
        <div class="programas">
            @foreach ($Programas as $Programa)
                <div class="border border-dark rounded ajustar">
                    <h2 class="text-center">{{$Programa->NombrePrograma}}</h2>
                    <div class="imagen"><img src="{{$Programa->imagen}}" alt="imagen de {{$Programa->NombrePrograma}}"></div>
                    <p class="sobretexto">{{$Programa->Descripcion}}</p>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('landingPage', $Programa->slug)}}" type="button" class="btn btn-primary text-center">Conoce más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>