@extends('layouts.app')
@section('title', 'Eventos')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/eventos.css') }}">
@endsection

@section('content')
    <h1 class="text-sena-green text-center">Eventos</h1>
    @foreach ($programa->eventos as $evento)
        <div class="container letras cajas text-dark p-4">
            Nombre: {{$evento->nombre}} <br><br>
            Descripcion: {{$evento->descripción}} <br><br>
            Fecha de inicializacion: {{$evento->Fecha}}
        </div><br>
    @endforeach

    <h2 class="text-center">Imagenes de {{$programa->NombrePrograma}}:</h2>
    <div class="container bg-sena-blue imagenes">
        @foreach ($programa->imagenes as $imagen)
        <div>
            <img src="{{Storage::url($imagen->imagen)}}" alt="$programa->NombrePrograma">
        </div>
        @endforeach
    </div>
@endsection

@section('Scripts')

@endsection