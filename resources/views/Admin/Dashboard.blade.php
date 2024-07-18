@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Informacion del portal web</h1>
@stop

@section('content')
    <div>
        <h2>Numero total de programas:</h2>
        <h3>{{$programas}} Programas</h3>
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
