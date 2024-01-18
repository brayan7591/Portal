@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Usuarios en el sistema</h1>
@stop

@section('content')
    @livewire('counter')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}} ">
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    <script>
        Livewire.on('alert', function (){
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo usuario",
                type: "success"
            })
        })
    </script>
@stop