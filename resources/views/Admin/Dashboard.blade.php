@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Informacion del portal web</h1>
@stop

@section('content')
    <div class="informacion">
        <h2>Numero total de programas:</h2>
        <h3 class="text-end">{{$programas}} {{$programas == 1 ? "programa" : "programas"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de usuarios:</h2>
        <h3 class="text-end">{{$usuarios}} {{$usuarios == 1 ? "usuario" : "usuarios"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de competencias:</h2>
        <h3 class="text-end">{{$competencias}} {{$competencias == 1 ? "competencia" : "competencias"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de instructores:</h2>
        <h3 class="text-end">{{$instructores}} {{$instructores == 1 ? "instructor" : "instructores"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de egresados destacados:</h2>
        <h3 class="text-end">{{$egresados}} {{$egresados == 1 ? "egresado" : "egresados"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de voceros:</h2>
        <h3 class="text-end">{{$voceros}} {{$voceros == 1 ? "vocero" : "voceros"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de aprendices destacados:</h2>
        <h3 class="text-end">{{$Aprendices}} {{$Aprendices == 1 ? "aprendiz" : "aprendices"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de proyectos:</h2>
        <h3 class="text-end">{{$proyectos}} {{$proyectos == 1 ? "proyecto" : "proyectos"}}</h3>
    </div>
    <div class="informacion mt-2">
        <h2>Numero total de eventos:</h2>
        <h3 class="text-end">{{$eventos}} {{$eventos == 1 ? "evento" : "eventos"}}</h3>
    </div>
@stop

@section('css')
@stop

@section('js')
    @if (session('success'))
        <script>
            setTimeout(function(){
                Swal.fire({
                    title: "Bien hecho!",
                    text: "{{session('success')}}",
                    type: "success"
                })
            }, 1000)
        </script>
    @endif
@stop
