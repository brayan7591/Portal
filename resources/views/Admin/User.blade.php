@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios en el sistema</h1>
@stop

@section('content')
    @livewire('users.mostrar-usuarios')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}} ">
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    <script>
        Livewire.on('alert', function (){
            document.getElementById('Closemodal').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo usuario",
                type: "success"
            })
        })
    </script>
@stop
