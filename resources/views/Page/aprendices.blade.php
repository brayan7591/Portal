@extends('layouts.app')
@section('title', 'Aprendices')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/aprendices.css') }}">
@endsection

@section('content')
    <h1 class="text-center">Aprendices</h1>
    @foreach ($programa->aprendices as $aprendiz)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$aprendiz->nombre}} <br><br>
            Correo: {{$aprendiz->correo}} <br><br>
            Numero de ficha: {{$aprendiz->numero_ficha ? $aprendiz->numero_ficha : 'No se registra un numero de ficha'}} <br><br>
            Motivo: {{$aprendiz->motivo}} 
            @if ($aprendiz->imagen)
            <br><br>
                Imagen: <br><br>
                <img src="{{Storage::url($aprendiz->imagen->url)}}" width="50px" height="50px" alt="Imagen de {{$aprendiz->nombre}}">
            @endif
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection