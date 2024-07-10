@extends('layouts.app')
@section('title', 'Proyectos')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/proyectos.css') }}">
@endsection

@section('content')
    <h1 class="text-center">Proyectos</h1>
    @foreach ($programa->proyectos as $proyecto)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$proyecto->Nombre}} <br><br>
            Objetivo: {{$proyecto->Objetivo}} <br><br>
            Justificacion: {{$proyecto->Justificacion}} <br><br>
            Fecha de inicio: {{$proyecto->FechaInicio}} <br><br>
            Fecha de finalizacion: {{$proyecto->FechaFinalizacion}}
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection