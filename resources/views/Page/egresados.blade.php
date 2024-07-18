@extends('layouts.app')
@section('title', 'Egresados')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/egresados.css') }}">
@endsection

@section('content')
    <h1 class="text-center"> <span class="lul">Egresados</span></h1>
    

    @foreach ($programa->egresados as $egresado)
    

        <div class="container text-dark blue fi p-4">
        @if ($egresado->imagen)
                <img src="{{Storage::url($egresado->imagen->url)}}" width="150px" height="150px" alt="Imagen de {{$egresado->nombre}}">
            @endif
            
            <div>
                <span class="lol">Nombre:</span> <span class="yt">{{$egresado->nombre}}</span>
                <hr>
                <span class="lal">Correo:</span> <span class="agh">{{$egresado->correo}}</span>
                <hr>
                <span class="lel">Numero de ficha:</span> <span class="hp">{{$egresado->numero_ficha ? $egresado->numero_ficha : 'No se registra un numero de ficha'}} </span>
                <hr>
                <span class="lil">Motivo:</span> <span class="jh">{{$egresado->motivo}}</span>
            </div>
            
            
        </div><br>
    @endforeach
    
@endsection

@section('Scripts')

@endsection+