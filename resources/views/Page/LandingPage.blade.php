@extends('layouts.app')
@section('title', 'Portal')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/inicio.css') }}">
@endsection

@section('content')
    <h1 class="text-center">{{$programa->NombrePrograma}}</h1>
    <p class="texto-prueba">{{$programa->Descripcion}}</p>
@endsection

@section('Scripts')
@endsection