@extends('adminlte::page')

@section('title', 'Mensajes entrantes')

@section('content_header')
    <h1 class="text-center">Mensajes del formulario del comienso</h1>
@stop

@section('content')
    @foreach ($formularios as $formulario)
        <div class="container letras cajas text-dark p-4">
            Nombre: {{$formulario->nombre}} <br><br>
            Telefono: {{$formulario->telefono}} <br><br>
            Correo: {{$formulario->correo}} <br><br>
            mensaje: {{$formulario->mensaje}}
        </div><br>
    @endforeach
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/principal/eventos.css') }}">
@stop

@section('js')

@stop