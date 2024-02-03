@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
    <h1>Bienvenido {{$user->name}} aqui podras actualizar tu perfil</h1>
@stop

@section('content')

    <form class="bg-dark p-3 border" action="{{route('settings.update')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nombre" class="form-label h5">Nombre:</label>
            <input type="text" class="form-control" id="Nombre" name="nombre" value="{{old('nombre', $user->name)}}" required>
            @error('nombre')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label h5">Correo:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}" required>
            @error('email')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label h5">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="my-2 d-flex justify-content-between">
            <a class="btn btn-success" href="{{route('CamContra')}}">Cambiar contraseña</a>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')
   
@stop
