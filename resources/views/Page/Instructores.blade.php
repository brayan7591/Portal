@extends('layouts.app')
@section('title', 'Instructores')

@section('content')
  @livewire('instructores.publico.mostrar-instructor', ['programa' => $programa])
@endsection