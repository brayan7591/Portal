@extends('layouts.app')
@section('title', 'Biblioteca')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/biblioteca.css') }}">
    @livewireStyles
@endsection

@section('content')
    <h1 class="text-center">La biblioteca de {{$programa->NombrePrograma}}</h1>
    <center><p>Bienvenido a la Biblioteca del Programa {{$programa->NombrePrograma}} </p>
    <p>Aquí encontrarás una variedad de recursos informativos diseñados para apoyar tu aprendizaje y desarrollo profesional. </p>
    <p>Explora nuestros libros y artículos disponibles para todos los aprendices y demas usuarios</p>
@livewire('principal.biblioteca', ['programaid' => $programa->id])</center>
@endsection

@section('Scripts')
    @livewireScripts
@endsection