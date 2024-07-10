@extends('layouts.app')
@section('title', 'Voceros')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/voceros.css') }}">
@endsection

@section('content')
    <h1 class="text-center">Voceros</h1>
    @foreach ($programa->voceros as $vocero)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$vocero->Nombre}} <br><br>
            Correo: {{$vocero->Email}} <br><br>
            Numero de ficha: {{$vocero->NoFicha}}
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection