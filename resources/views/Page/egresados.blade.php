@extends('layouts.app')
@section('title', 'Egresados')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/egresados.css') }}">
@endsection

@section('content')
    <h1 class="text-center">Egresados</h1>
    @foreach ($programa->egresados as $egresado)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$egresado->nombre}} <br><br>
            Correo: {{$egresado->correo}} <br><br>
            Numero de ficha: {{$egresado->numero_ficha ? $egresado->numero_ficha : 'No se registra un numero de ficha'}} <br><br>
            Motivo: {{$egresado->motivo}} 
            @if ($egresado->imagen)
            <br><br>
                Imagen: <br><br>
                <img src="{{Storage::url($egresado->imagen->url)}}" width="50px" height="50px" alt="Imagen de {{$egresado->nombre}}">
            @endif
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection