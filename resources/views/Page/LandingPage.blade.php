@extends('layouts.app')
@section('title', 'Portal')

@section('content')
    <h1 class="text-center">{{$programa->NombrePrograma}}</h1>
    <p>{{$programa->Descripcion}}</p>
@endsection