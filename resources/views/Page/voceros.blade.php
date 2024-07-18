@extends('layouts.app')
@section('title', 'Voceros')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/voceros.css') }}">
@endsection

@section('content')
    <h1 class="text-center"> <span class="pi">Voceros</span></h1>
    @foreach ($programa->voceros as $vocero)
        <div class="container text-white blue p-4">
            <span class="pr">Nombre:</span> {{$vocero->Nombre}}
            <hr>
            <span class="uy">Correo:</span> {{$vocero->Email}} 
            <hr>
            <span class="ln">Numero de Ficha:</span> {{$vocero->NoFicha}}
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection