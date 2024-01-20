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
        Livewire.on('Actualizado', function(){
            document.getElementById('ClosemodalUpdate').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has Actualizado el usuario",
                type: "success"
            })
        })
    </script>
@stop
