@extends('layouts.app')
@section('title', 'Biblioteca')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/biblioteca.css') }}">
    @livewireStyles
@endsection

@section('content')
    <h1 class="text-center">La biblioteca de {{$programa->NombrePrograma}}</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit minus sit doloremque quaerat labore architecto cum, corporis et consequatur sunt, esse maxime perferendis, voluptas ratione tenetur ab veniam. Molestiae, nulla.</p>
    @livewire('principal.biblioteca', ['programaid' => $programa->id])
@endsection

@section('Scripts')
    @livewireScripts
@endsection