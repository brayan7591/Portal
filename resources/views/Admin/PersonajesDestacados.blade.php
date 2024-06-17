@extends('adminlte::page')

@section('title', 'Egresados y Aprendices')

@section('content_header')
    <h1 class="text-center">EGRESADOS Y APRENDICES</h1>
@stop

@section('content')
    <livewire:admin.personajes-destacados lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/tablas.css')}} ">
@stop

@section('js')

@stop