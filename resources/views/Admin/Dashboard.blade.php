@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
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
