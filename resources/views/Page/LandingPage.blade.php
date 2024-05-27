@extends('layouts.app')
@section('title', 'Portal')

@section('content')
    <h1 class="text-center">{{$programa->NombrePrograma}}</h1>
    <p class="texto-prueba">{{$programa->Descripcion}}</p>
    
@endsection

@section('Scripts')
@endsection