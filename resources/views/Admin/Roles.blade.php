@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles en el sistema</h1>
@stop

@section('content')
    @livewire('roles.mostrar-roles')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/TableAdmin.css')}} ">
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
