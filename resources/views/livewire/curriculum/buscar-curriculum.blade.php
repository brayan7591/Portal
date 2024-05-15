<div class="d-flex justify-content-center align-items-center flex-column">
    <div class="contenedor">
        <div class="input-group input-group-lg w-100 completo todo color ">
            <input type="text" class="form-control input-color color h1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" wire:model.live="searchnorma" placeholder="Buscar Competencias por norma, codigo o nombre (susceptible a tildes)">
        </div>
    </div>
    @if ($competencias->count() > 0)
        @foreach ($competencias as $value => $competencia)
        <div class="contenedor">
            <p class="completo justify-content-center todo h1 color">{{$value + 1}} CONTENIDO CURRICULAR DE LA COMPETENCIA</p>
            <h2 class="uno todo color">{{$value + 1}}.1 NORMA / UNIDAD DE COMPETENCIA</h2>
            <h3 class="dos todo">{{$competencia->norma}}</h3>
            <h2 class="uno todo color">{{$value + 1}}.2 CÓDIGO NORMA DE COMPETENCIA LABORAL</h2>
            <h3 class="dos todo">{{$competencia->codigo}}</h3>
            <h2 class="uno todo color">{{$value + 1}}.3 NOMBRE DE LA COMPETENCIA</h2>
            <h3 class="dos todo">{{$competencia->nombre}}</h3>
            <h2 class="uno-tres todo color">{{$value + 1}}.4 DURACION MAXIMA ESTIMADA PARA EL LOGRO DEL APRENDIZAJE</h2>
            <h3 class="tres-cuatro todo">{{$competencia->duracion}} Horas</h3>
            <p class="completo justify-content-center todo h2 color">{{$value + 1}}.5 RESULTADOS DE APRENDIZAJE (RAPS)</p>
            @if ($competencia->raps->count() > 0)
                @foreach ($competencia->raps as $value2 => $rap)
                    <p class="completo todo h3">{{$value2 + 1}}. {{$rap->descripcion}}</p>
                @endforeach
            @else
                <p class="completo justify-content-center todo h3">No hay raps para esta competencia por el momento</p>
            @endif
            <p class="completo justify-content-center todo h2 color">{{$value + 1}}.6 SABERES, CONCEPTOS Y PRINCIPIOS</p>
            @if ($competencia->conceptos->count() > 0)
                @foreach ($competencia->conceptos as $value2 => $concepto)
                    <p class="completo todo h3">{{$value2 + 1}}. {{$concepto->descripcion}}</p>
                    @if ($concepto->detalle->count() > 0)
                        @foreach ($concepto->detalle as $value3 => $detalle)
                            <p class="completo todo h4">{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</p>
                        @endforeach
                    @endif
                @endforeach
            @else
                <p class="completo justify-content-center todo h3">No hay saberes, conceptos o principios para esta competencia por el momento</p>
            @endif
            <p class="completo justify-content-center todo h2 color">{{$value + 1}}.7 SABERES DE PROCESOS</p>
            @if ($competencia->saberes->count() > 0)
                @foreach ($competencia->saberes as $value2 => $saber)
                    <p class="completo todo h3">{{$value2 + 1}}. {{$saber->descripcion}}</p>
                    @if ($saber->detalle->count() > 0)
                        @foreach ($saber->detalle as $value3 => $detalle)
                            <p class="completo todo h4">{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</p>
                        @endforeach
                    @endif
                @endforeach
            @else
                <p class="completo justify-content-center todo h3">No hay saberes de proceso para esta competencia por el momento</p>
            @endif
        </div>
        @endforeach
    @else
        <div class="contenedor">
            <p class="completo justify-content-center todo h1 color">NO SE ENCONTRO</p>
            <h2 class="uno todo color">NORMA / UNIDAD DE COMPETENCIA</h2>
            <h3 class="dos todo">{{$searchnorma == '' ? 'No hay competencias por el momento' : $searchnorma}}</h3>
            <h2 class="uno todo color">CÓDIGO NORMA DE COMPETENCIA LABORAL</h2>
            <h3 class="dos todo">ERROR 404</h3>
            <h2 class="uno todo color">NOMBRE DE LA COMPETENCIA</h2>
            <h3 class="dos todo">ERROR 404</h3>
            <h2 class="uno-tres todo color">DURACION MAXIMA ESTIMADA PARA EL LOGRO DEL APRENDIZAJE</h2>
            <h3 class="tres-cuatro todo">404 Horas</h3>
            <p class="completo justify-content-center todo h2 color">RESULTADOS DE APRENDIZAJE (RAPS)</p>
            <p class="completo todo h3">Error 404</p>
            <p class="completo justify-content-center todo h2 color">SABERES, CONCEPTOS Y PRINCIPIOS</p>
            <p class="completo todo h3">Error 404</p>
            <p class="completo justify-content-center todo h2 color">SABERES DE PROCESOS</p>
            <p class="completo todo h3">Error 404</p>
        </div>
    @endif
</div>