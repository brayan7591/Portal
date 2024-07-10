@extends('layouts.app')
@section('title', 'Instructores')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/instructores.css') }}">
@endsection

@section('content')
  @foreach ($programa->instructores as $instructor)
        <div class="container bg-light text-dark p-4">
            Nombre: {{$instructor->Nombre}} <br><br>
            Correo: {{$instructor->Email}} <br><br>
            Especialidad: {{$instructor->Especialidad}} <br><br>
            Telefono: {{$instructor->Telefono}} <br><br>
            Descripcion: {{$instructor->Descripcion}} <br><br>
            Jornada: {{$instructor->jornada}} <br><br>
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection