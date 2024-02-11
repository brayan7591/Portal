@extends('adminlte::page')

@section('title', 'Biblioteca')

@section('content_header')
    <h1>Biblioteca</h1>
@stop

@section('content')
    @livewire('biblioteca.privado.mostrar-libros')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/libroAdmin.css') }}">
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    <script>
        Livewire.on('alertLibros', function (){
            document.getElementById('CerrarLibro').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo libro",
                type: "success"
            })
        })
    </script>
@stop
