@extends('layouts.app')
@section('title', 'Aprendices')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/aprendices.css') }}">
@endsection

@section('content')
    <h1 class="text-center"> <span class="lyl">Aprendices</span></h1>
    @foreach ($programa->aprendices as $aprendiz)
        <div class="container text-white blue p-4">
            <span class="lil">Nombre:</span> {{$aprendiz->nombre}}
            <hr>
            <span class="lul">Correo:</span> {{$aprendiz->correo}}
            <hr>
            <span class="lol">Numero de Ficha:</span> {{$aprendiz->numero_ficha ? $aprendiz->numero_ficha : 'No se registra un numero de ficha'}} 
            <hr>
            <span class="lel">Motivo:</span> {{$aprendiz->motivo}} 
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