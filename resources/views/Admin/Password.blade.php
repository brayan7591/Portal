@extends('adminlte::page')

@section('title', 'Cambiar contraseña')

@section('content_header')
    <h1>Bienvenido {{Auth::user()->name}} aqui podras actualizar tu contraseña</h1>
@stop

@section('content')

    <form class="bg-dark p-3 border" action="{{route('password.update')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="OldPassword" class="form-label h5">Contraseña anterior:</label>
            <input type="password" class="form-control" id="OldPassword" name="OldPassword" required>
            @error('OldPassword')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="NewPassword" class="form-label h5">Contraseña nueva:</label>
            <input type="password" class="form-control" id="NewPassword" name="NewPassword" required>
            @error('NewPassword')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ConfirmPassword" class="form-label h5">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" required>
            @error('ConfirmPassword')
                <div class="form-text bg-warning">{{$message}}</div>
            @enderror
        </div>
        <div class="my-2 d-flex justify-content-between">
            <a class="btn btn-success" href="{{route('settings')}}">Otras configuraciones</a>
            <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')

@stop
