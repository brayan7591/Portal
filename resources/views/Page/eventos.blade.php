@extends('layouts.app')
@section('title', 'Eventos')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/eventos.css') }}">
@endsection

@section('content')
    <h1 class="text-center">Eventos</h1>
    @foreach ($programa->eventos as $evento)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$evento->nombre}} <br><br>
            Descripcion: {{$evento->descripción}} <br><br>
            Fecha de inicializacion: {{$evento->Fecha}}
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection