<div class="contenedor">
    <div class="input-group input-group-lg w-100 completo todo color ">
        <input type="text" class="form-control input-color color h1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" wire:model="searchnorma" placeholder="Buscar Competencias">
    </div>
    @if ($competencias->count() > 0)
        @foreach ($competencias as $value => $competencia)
            <p class="completo text-center todo h1 color">{{$value + 1}} CONTENIDO CURRICULAR DE LA COMPETENCIA</p>
            <h2 class="uno todo color">{{$value + 1}}.1 NORMA / UNIDAD DE COMPETENCIA</h2>
            <h3 class="dos todo">{{$competencia->norma}}</h3>
            <h2 class="uno todo color">{{$value + 1}}.2 CÓDIGO NORMA DE COMPETENCIA LABORAL</h2>
            <h3 class="dos todo">{{$competencia->codigo}}</h3>
            <h2 class="uno todo color">{{$value + 1}}.3 NOMBRE DE LA COMPETENCIA</h2>
            <h3 class="dos todo">{{$competencia->nombre}}</h3>
            <h2 class="uno-tres todo color">{{$value + 1}}.4 DURACION MAXIMA ESTIMADA PARA EL LOGRO DEL APRENDIZAJE</h2>
            <h3 class="tres-cuatro todo">{{$competencia->duracion}} Horas</h3>
            <p class="completo text-center todo h2 color">{{$value + 1}}.5 RESULTADOS DE APRENDIZAJE (RAPS)</p>
            @if ($competencia->raps->count() > 0)
                @foreach ($competencia->raps as $value2 => $rap)
                    <p class="completo text-center todo h3">{{$value2 + 1}}. {{$rap->descripcion}}</p>
                @endforeach
            @else
                <p class="completo text-center todo h3">No hay raps para esta competencia el momento</p>
            @endif
        @endforeach
    @else
        <p class="completo text-center todo h1 color">NO SE ENCONTRO</p>
        <h2 class="uno todo color">NORMA / UNIDAD DE COMPETENCIA</h2>
        <h3 class="dos todo">{{$searchnorma}}</h3>
        <h2 class="uno todo color">CÓDIGO NORMA DE COMPETENCIA LABORAL</h2>
        <h3 class="dos todo">ERROR</h3>
        <h2 class="uno todo color">NOMBRE DE LA COMPETENCIA</h2>
        <h3 class="dos todo">ERROR</h3>
        <h2 class="uno-tres todo color">DURACION MAXIMA ESTIMADA PARA EL LOGRO DEL APRENDIZAJE</h2>
        <h3 class="tres-cuatro todo">404 Horas</h3>
    @endif
    
</div>