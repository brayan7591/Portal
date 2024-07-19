@extends('layouts.app')
@section('title', 'Instructores')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/principal/instructores.css') }}">
@endsection

@section('content')
      <h1 class="text-center"> <span class="lul">Instructores</span></h1>
    
  @foreach ($programa->instructores as $instructor)
        <div class="container text-white blue p-4">
        @if ($instructor->imagen)
                <img src="{{Storage::url($instructor->imagen->url)}}" width="150px" height="150px" alt="Imagen de {{$instructor->nombre}}">
            @endif
            <span class="p">Nombre:</span> {{$instructor->Nombre}}
            <hr>
            <span class="o">Correo:</span> {{$instructor->Email}}
            <hr>
            <span class="l">Especialidad:</span> {{$instructor->Especialidad}}
            <hr>
            <span class="m">Telefono:</span> {{$instructor->Telefono}} 
            <hr>
            <span class="n">Descripcion:</span> {{$instructor->Descripcion}} 
            <hr>
            <span class="b">Jornada: </span> {{$instructor->jornada}} <br><br>
        </div><br>
    @endforeach
@endsection

@section('Scripts')

@endsection

