@extends('layouts.app')
@section('title', 'Instructores')
@section('links') <link rel="stylesheet" href="{{asset('css/personajes.css')}}"> @endsection
@section('content')
  @livewire('instructores.publico.mostrar-instructor', ['programa' => $programa])
@endsection