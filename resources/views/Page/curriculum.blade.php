@extends('layouts.app')
@section('title', 'Curriculum')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/curriculum.css') }}">
    @livewireStyles
@endsection

@section('content')
    <div class="contenedor">
        <p class="completo text-center todo h1 color">1. INFORMACION BASICA DEL PROGRAMA DE FORMACION TITULADA</p>
        <h2 class="uno todo color">1.1 DENOMINACION DEL PROGRAMA:</h2>
        <h3 class="dos todo">{{$programa->NombrePrograma}}</h3>
        <h2 class="uno todo color">1.2 CODIGO DEL PROGRAMA:</h2>
        <h3 class="dos todo">{{$programa->codigoPrograma}}</h3>
        <h2 class="uno todo color">1.3 VERSION DEL PROGRAMA</h2>
        <h3 class="dos todo">1</h3>
        <h2 class="uno todo color">1.4 VIGENCIA DEL PROGRAMA </h2>
        <div class="dos todo fechas">
            <h3 class="color centrado-total">Fecha de inicio:</h3>
            <h3 class="centrado-total">{{$nivelaceptado->FechaInicio}}</h3>
            <h3 class="color centrado-total">Fecha de finalización:</h3>
            <h3 class="centrado-total">{{$nivelaceptado->FechaFin ? $nivelaceptado->FechaFin : 'El programa aun se encuentra vigente'}}</h3>
        </div>
        <h2 class="uno todo color">1.5 DURACIÓN MÁXIMA ESTIMADA DEL APRENDIZAJE (Horas) </h2>
        <div class="dos todo horas">
            <h3 class="color centrado-total">Etapa Lectiva</h3>
            <h3 class="centrado-total">{{$nivelaceptado->HorasEtapaLectiva}} Horas</h3>
            <h3 class="color centrado-total">Etapa Productiva</h3>
            <h3 class="centrado-total">{{$nivelaceptado->HorasEtapaProductiva}} Horas</h3>
            <h3 class="color centrado-total">Total:</h3>
            <h3 class="centrado-total">{{$nivelaceptado->HorasEtapaLectiva + $nivelaceptado->HorasEtapaProductiva}} Horas</h3>
        </div>
        <h2 class="uno todo color">1.6 TIPO DEL PROGRAMA</h2>
        <h3 class="dos todo">Titulado</h3>
        <h2 class="uno todo color">1.7 TITULO O CERTIFICADO QUE OBTENDRA:</h2>
        <h3 class="dos todo">{{ucfirst($nivelaceptado->nivel)}}</h3>
    </div>
    @livewire('curriculum.buscar-curriculum', ['nivel' => $nivelaceptado])
@endsection

@section('Scripts')
    @livewireScripts
@endsection