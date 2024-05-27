<div>
    <p class="my-0">Buscar: </p>
    <select class="form-control me-2 mb-2" wire:model.live="model">
        <option value="programas">Programas</option>
        <option value="competencias">Competencias</option>
    </select>
    <div wire:loading wire:target="model" class="w-100 d-flex align-items-center justify-content-between">
        <strong wire:loading wire:target="model" role="status">Loading...</strong>
        <div wire:loading wire:target="model" class="spinner-border ms-auto" aria-hidden="true"></div>
    </div>
    <div wire:loading.remove wire:target="model">
        @if ($model == 'programas')
            <div wire:key="programas">
                <p class="my-0">Seleccione el programa de formacion: </p>
                <select class="form-control me-2" wire:model.live="search">
                    <option value="">Todos</option>
                    @if ($model == 'programas')
                        @foreach ($programas as $programa)
                            <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        @else
            <div wire:key="competencias">
                <p class="my-0">Buscar por: </p>
                <select class="form-control me-2"  wire:model.live="for">
                    <option value="norma">Norma</option>
                    <option value="codigo">Codigo</option>
                    <option value="nombre">Nombre</option>
                    <option value="duracion">Duracion</option>
                </select>
                <label class="w-100">
                    <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model.live="search">
                </label>
            </div>
        @endif
        
        
        
        <div class="d-flex justify-content-between align-items-center mt-2">
            <div>
                <span>Mostrar</span>
                <select wire:model.live="registers">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="5">5</option>
                </select>
                <span>resultados</span>
            </div>
            @can('Curriculum.crear')
                @if ($model == 'programas')
                    <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#AgregarPrograma">Agregar Programa</button>
                @else
                    <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#AgregarCompetencia">Agregar Competencia</button>
                @endif
            @endcan
        </div>

        @if ($model == 'programas')

            @if ($niveles->count() > 0)
                @foreach ($niveles as $nivel)
                    <div class="contenedor w-100">
                        <p class="completo text-center todo h1 color">1. INFORMACIÓN BASICA DEL PROGRAMA DE FORMACION TITULADA</p>
                        <h2 class="uno todo color">1.1 DENOMINACION DEL PROGRAMA:</h2>
                        <h3 class="dos todo">{{$nivel->programa->NombrePrograma}}</h3>
                        <h2 class="uno todo color">1.2 CODIGO DEL PROGRAMA:</h2>
                        <h3 class="dos todo">{{$nivel->programa->codigoPrograma}}</h3>
                        <h2 class="uno todo color">1.3 VERSION DEL PROGRAMA</h2>
                        <h3 class="dos todo">1</h3>
                        <h2 class="uno todo color">1.4 VIGENCIA DEL PROGRAMA </h2>
                        <div class="dos todo fechas">
                            <h3 class="color centrado-total">Fecha de inicio:</h3>
                            <h3 class="centrado-total">{{$nivel->FechaInicio}}</h3>
                            <h3 class="color centrado-total">Fecha de finalización:</h3>
                            <h3 class="centrado-total justify-content-center">{{$nivel->FechaFin ? $nivel->FechaFin : 'El programa aun se encuentra vigente'}}</h3>
                        </div>
                        <h2 class="uno todo color">1.5 DURACIÓN MÁXIMA ESTIMADA DEL APRENDIZAJE (Horas) </h2>
                        <div class="dos todo horas">
                            <h3 class="color centrado-total">Etapa Lectiva</h3>
                            <h3 class="centrado-total">{{$nivel->HorasEtapaLectiva}} Horas</h3>
                            <h3 class="color centrado-total">Etapa Productiva</h3>
                            <h3 class="centrado-total">{{$nivel->HorasEtapaProductiva}} Horas</h3>
                            <h3 class="color centrado-total">Total:</h3>
                            <h3 class="centrado-total">{{$nivel->HorasEtapaLectiva + $nivel->HorasEtapaProductiva}} Horas</h3>
                        </div>
                        <h2 class="uno todo color">1.6 TIPO DEL PROGRAMA</h2>
                        <h3 class="dos todo">Titulado</h3>
                        <h2 class="uno todo color">1.7 TITULO O CERTIFICADO QUE OBTENDRA:</h2>
                        <h3 class="dos todo">{{$nivel->Nivel}}</h3>
                        <p class="completo justify-content-center todo h2 color">1.8 Competencias que contiene:</p>
                            @if ($nivel->competencias->count() > 0)
                                @foreach ($nivel->competencias as $competencia)
                                    <p class="completo todo h3">{{$competencia->codigo}}: {{$competencia->norma}}</p>
                                @endforeach
                            @else
                                <p class="completo todo h3">No tiene competencias por el momento</p>
                            @endif
                            @can('Curriculum.editar')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#ModificarPrograma" wire:click="updatePrograma({{$nivel}})"">Actualizar información</button>
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger h2" wire:click="$dispatch('deleteProgramaNivel', {{$nivel}})">Borrar curriculum de  {{$nivel->SlugInterno}} en  {{$nivel->programa->NombrePrograma}}</button>
                                    @endcan
                                </p>
                            @elsecan('Curriculum.destruir')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-danger h2" wire:click="$dispatch('deleteProgramaNivel', {{$nivel}})">Borrar curriculum de  {{$nivel->SlugInterno}} en  {{$nivel->programa->NombrePrograma}}</button>
                                </p>
                            @endcan
                    </div><br>
                @endforeach
                @if ($niveles->hasPages())
                    <div>
                        {{$niveles->links()}}
                    </div>
                @endif
            @else
                <div class="contenedor w-100">
                    <p class="completo text-center todo h1 color">1. INFORMACIÓN BASICA DEL PROGRAMA DE FORMACION TITULADA</p>
                    <h2 class="uno todo color">1.1 DENOMINACION DEL PROGRAMA:</h2>
                    <h3 class="dos todo">No hay Error 404</h3>
                    <h2 class="uno todo color">1.2 CODIGO DEL PROGRAMA:</h2>
                    <h3 class="dos todo">No hay Error 404</h3>
                    <h2 class="uno todo color">1.3 VERSION DEL PROGRAMA</h2>
                    <h3 class="dos todo">No hay Error 404</h3>
                    <h2 class="uno todo color">1.4 VIGENCIA DEL PROGRAMA </h2>
                    <div class="dos todo fechas">
                        <h3 class="color centrado-total">Fecha de inicio:</h3>
                        <h3 class="centrado-total">404/404/404</h3>
                        <h3 class="color centrado-total">Fecha de finalización:</h3>
                        <h3 class="centrado-total justify-content-center">404/404/404</h3>
                    </div>
                    <h2 class="uno todo color">1.5 DURACIÓN MÁXIMA ESTIMADA DEL APRENDIZAJE (Horas) </h2>
                    <div class="dos todo horas">
                        <h3 class="color centrado-total">Etapa Lectiva</h3>
                        <h3 class="centrado-total">404 Horas</h3>
                        <h3 class="color centrado-total">Etapa Productiva</h3>
                        <h3 class="centrado-total">404 Horas</h3>
                        <h3 class="color centrado-total">Total:</h3>
                        <h3 class="centrado-total">404 Horas</h3>
                    </div>
                    <h2 class="uno todo color">1.6 TIPO DEL PROGRAMA</h2>
                    <h3 class="dos todo">No hay Error 404</h3>
                    <h2 class="uno todo color">1.7 TITULO O CERTIFICADO QUE OBTENDRA:</h2>
                    <h3 class="dos todo">No hay Error 404</h3>
                    <p class="completo justify-content-center todo h2 color">1.8 Competencias que contiene:</p>
                    <p class="completo todo h3">Error 404</p>
                </div>
            @endif
        @else
            @if ($competencias->count() > 0)
                @foreach ($competencias as $value => $competencia)
                    <div class="contenedor w-100">
                        <p class="completo justify-content-center todo h1 color">{{$value + 1}} {{$competencia->nombre}}</p>
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
                            
                                <p class="completo todo h3">{{$value2 + 1}}. {{$rap->descripcion}}
                                    @can('Curriculum.editar')
                                        <button class="btn btn-primary mr-2 ml-2" type="button" data-toggle="modal" data-target="#ModificarDatos" wire:click="ActualizarDato('rap', {{$rap->id}})"><i class="fa fa-pen"></i></button>
                                    @endcan
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deleteDato', [{{$rap->id}}, 'rap'])"><i class="fa fa-trash"></i></button>
                                    @endcan
                                </p>

                            @endforeach

                                @can('Curriculum.crear')
                                    <p class="completo justify-content-between todo h2">
                                        <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('rap', {{$competencia->codigo}})">Agregar nuevo rap</button>
                                        @can('Curriculum.destruir')
                                            <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'rap'])">Eliminar todos los raps</button>
                                        @endcan
                                    </p>
                                @elsecan('Curriculum.destruir')
                                    <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'rap'])">Eliminar todos los raps</button>
                                @endcan
                        @else
                            <p class="completo justify-content-center todo h3">No hay raps para esta competencia por el momento 
                                @can('Curriculum.crear')
                                    <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('rap', {{$competencia->codigo}})"><i class="fa fa-plus"></i></button>
                                @endcan
                            </p>
                        @endif
                        <p class="completo justify-content-center todo h2 color">{{$value + 1}}.6 SABERES, CONCEPTOS Y PRINCIPIOS</p>
                        @if ($competencia->conceptos->count() > 0)
                            @foreach ($competencia->conceptos as $value2 => $concepto)
                                <p class="completo todo h3">{{$value2 + 1}}. {{$concepto->descripcion}}
                                    @can('Curriculum.editar')
                                        <button class="btn btn-primary mr-2 ml-2" type="button" data-toggle="modal" data-target="#ModificarDatos" wire:click="ActualizarDato('saber', {{$concepto->id}})"><i class="fa fa-pen"></i></button>
                                    @endcan
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deleteDato', [{{$concepto->id}}, 'saber'])"><i class="fa fa-trash"></i></button>
                                    @endcan
                                </p>
                                @if ($concepto->detalle->count() > 0)
                                    @foreach ($concepto->detalle as $value3 => $detalle)
                                        <p class="completo todo h4"><span class="ml-3">{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</span>
                                            @can('Curriculum.editar')
                                                <button class="btn btn-primary mr-2 ml-2" type="button" data-toggle="modal" data-target="#ModificarDatos" wire:click="ActualizarDato('detalle', {{$detalle->id}})"><i class="fa fa-pen"></i></button>
                                            @endcan
                                            @can('Curriculum.destruir')
                                                <button class="btn btn-danger" wire:click="$dispatch('deleteDato', [{{$detalle->id}}, 'detalle'])"><i class="fa fa-trash"></i></button>                                                
                                            @endcan
                                        </p>
                                    @endforeach
                                    @can('Curriculum.crear')
                                        <p class="completo justify-content-between todo h4">
                                            <button class="ml-3 btn btn-primary h4" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('detalle', {{$concepto->id}})">Agregar nuevo detalle</button>
                                            @can('Curriculum.destruir')
                                                <button class="mr-3 btn btn-danger h4" wire:click="$dispatch('deleteTodosDato', [{{$concepto->id}}, 'detalle'])">Eliminar todos los detalles de conceptos</button>
                                            @endcan
                                        </p>
                                    @elsecan('Curriculum.destruir')
                                        <p class="completo justify-content-between todo h4">
                                            <button class="mr-3 btn btn-danger h4" wire:click="$dispatch('deleteTodosDato', [{{$concepto->id}}, 'detalle'])">Eliminar todos los detalles de conceptos</button>
                                        </p>
                                    @endcan
                                    
                                @else
                                    <p class="completo todo h4"><span class="ml-3">No hay detalles por el momento de este proceso</span>
                                        @can('Curriculum.crear')
                                            <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('detalle', {{$concepto->id}})"><i class="fa fa-plus"></i></button>
                                        @endcan
                                    </p>
                                @endif
                            @endforeach
                            @can('Curriculum.crear')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('concepto', {{$competencia->codigo}})">Agregar nuevo concepto</button>
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'concepto'])">Eliminar todos los conceptos</button>
                                    @endcan
                                </p>
                            @elsecan('Curriculum.destruir')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'concepto'])">Eliminar todos los conceptos</button>
                                </p>
                            @endcan
                        @else
                            <p class="completo justify-content-center todo h3">No hay saberes, conceptos o principios para esta competencia por el momento 
                                @can('Curriculum.crear')
                                    <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('concepto', {{$competencia->codigo}})"><i class="fa fa-plus"></i></button>
                                @endcan
                            </p>
                        @endif
                        <p class="completo justify-content-center todo h2 color">{{$value + 1}}.7 SABERES DE PROCESOS</p>
                        @if ($competencia->saberes->count() > 0)
                            @foreach ($competencia->saberes as $value2 => $saber)
                                <p class="completo todo h3">{{$value2 + 1}}. {{$saber->descripcion}}
                                    @can('Curriculum.editar')
                                        <button class="btn btn-primary mr-2 ml-2" type="button" data-toggle="modal" data-target="#ModificarDatos" wire:click="ActualizarDato('saber', {{$saber->id}})"><i class="fa fa-pen"></i></button>
                                    @endcan
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deleteDato', [{{$saber->id}}, 'saber'])"><i class="fa fa-trash"></i></button>
                                    @endcan
                                </p>
                                @if ($saber->detalle->count() > 0)
                                    @foreach ($saber->detalle as $value3 => $detalle)
                                        <p class="completo todo h4"><span class="ml-3">{{$value2 + 1}}.{{$value3 + 1}} {{$detalle->descripcion}}</span>
                                            @can('Curriculum.editar')
                                                <button class="btn btn-primary mr-2 ml-2" type="button" data-toggle="modal" data-target="#ModificarDatos" wire:click="ActualizarDato('detalle', {{$detalle->id}})"><i class="fa fa-pen"></i></button>
                                            @endcan
                                            @can('Curriculum.destruir')
                                                <button class="btn btn-danger" wire:click="$dispatch('deleteDato', [{{$detalle->id}}, 'detalle'])"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </p>
                                    @endforeach
                                    @can('Curriculum.crear')
                                        <p class="completo justify-content-between todo h4">
                                            <button class="btn btn-primary h4 ml-3" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('detalle', {{$saber->id}})">Agregar nuevo detalle</button>
                                            @can('Curriculum.destruir')
                                                <button class="btn btn-danger h4 mr-3" wire:click="$dispatch('deleteTodosDato', [{{$saber->id}}, 'detalle'])">Eliminar todos los detalles de saberes</button>
                                            @endcan
                                        </p>
                                    @elsecan('Curriculum.destruir')
                                        <p class="completo justify-content-between todo h4">
                                            <button class="btn btn-danger h4 mr-3" wire:click="$dispatch('deleteTodosDato', [{{$saber->id}}, 'detalle'])">Eliminar todos los detalles de saberes</button>
                                        </p>
                                    @endcan
                                @else
                                    <p class="completo todo h4"><span class="ml-3">No hay detalles por el momento de este saber</span>
                                        @can('Curriculum.crear')
                                            <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('detalle', {{$saber->id}})"><i class="fa fa-plus"></i></button>
                                        @endcan
                                    </p>
                                @endif
                            @endforeach
                            @can('Curriculum.crear')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('saber', {{$competencia->codigo}})">Agregar nuevo saber</button>
                                    @can('Curriculum.destruir')
                                        <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'saber'])">Eliminar todos los saberes</button>
                                    @endcan
                                </p>
                            @elsecan('Curriculum.destruir')
                                <p class="completo justify-content-between todo h2">
                                    <button class="btn btn-danger h2" wire:click="$dispatch('deleteTodosDato', [{{$competencia->codigo}}, 'saber'])">Eliminar todos los saberes</button>
                                </p>
                            @endcan
                        @else
                            <p class="completo justify-content-center todo h3">No hay saberes de proceso para esta competencia por el momento 
                                @can('Curriculum.crear')
                                    <button class="btn btn-primary ml-2" type="button" data-toggle="modal" data-target="#AgregarDatos" wire:click="AgregarDatoFuncion('saber', {{$competencia->codigo}})"><i class="fa fa-plus"></i></button>
                                @endcan
                            </p>
                        @endif
                        <p class="completo justify-content-center todo h2 color">{{$value + 1}}.8 Programas en los cuales esta:</p>
                        @if ($competencia->niveles->count() > 0)
                            @foreach ($competencia->niveles as $nivel)
                                <p class="completo todo h3">{{$nivel->programa->NombrePrograma}}: {{$nivel->Nivel}}</p>
                            @endforeach
                        @else
                            <p class="completo todo h3">No hay programas vinculados con esta competencia</p>
                        @endif
                        @can('Curriculum.editar')
                            <p class="completo justify-content-between todo h2">
                                <button class="btn btn-primary h2" type="button" data-toggle="modal" data-target="#ActualizarCompetencia" wire:click="ActualizarCompetencia({{$competencia->codigo}})">Actualizar información</button>
                                @can('Curriculum.destruir')
                                    <button class="btn btn-danger h2" wire:click="$dispatch('deleteCompetencia', {{$competencia->codigo}})">Borrar competencia</button>
                                @endcan
                            </p>
                        @elsecan('Curriculum.destruir')
                            <p class="completo justify-content-between todo h2">
                                <button class="btn btn-danger h2" wire:click="$dispatch('deleteCompetencia', {{$competencia->codigo}})">Borrar competencia</button>
                            </p>
                        @endcan
                        
                    </div><br>
                @endforeach
                @if ($competencias->hasPages())
                    <div>
                        {{$competencias->links()}}
                    </div>
                @endif
            @else
                <div class="contenedor w-100">
                    <p class="completo justify-content-center todo h1 color">NO SE ENCONTRO</p>
                    <h2 class="uno todo color">NORMA / UNIDAD DE COMPETENCIA</h2>
                    <h3 class="dos todo">{{$search == '' ? 'No hay competencias por el momento' : $search}}</h3>
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
        @endif

        <!--Modal de actualizacion y agregación-->
        @if ($model == 'programas')
            @can('Curriculum.editar')
                <div class="modal fade" id="ModificarPrograma" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Programa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div wire:loading wire:target="updatePrograma" class="w-100 d-flex align-items-center justify-content-between">
                                <strong wire:loading wire:target="updatePrograma" role="status">Loading...</strong>
                                <div wire:loading wire:target="updatePrograma" class="spinner-border ms-auto" aria-hidden="true"></div>
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <label for="Actualizar_Nivel" class="form-label h4 font-weight-normal">Actualiza la fecha de inicio:</label>
                                <input type="text" class="form-control" id="Actualizar_Nivel" wire:model.live='actNivel'>
                                @error('actNivel')
                                    <span>{{$message}}</span>
                                @enderror
                                @if ($mensajeExistente)
                                    <p>Este nivel ya esta siendo ocupado por este programa</p>
                                @endif
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <label for="Actualizar_Fecha_Inicio" class="form-label h4 font-weight-normal">Actualiza la fecha de inicio:</label>
                                <input type="date" class="form-control" id="Actualizar_Fecha_Inicio" wire:model='actFechaInicio'>
                                @error('actFechaInicio')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <label for="Actualizar_Fecha_Final" class="form-label h4 font-weight-normal">Actualiza la fecha de finalización:</label>
                                <input type="date" class="form-control" id="Actualizar_Fecha_Final" wire:model='actFechaFinal'>
                                @error('actFechaFinal')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <label for="Actualizar_Hora_Lectiva" class="form-label h4 font-weight-normal">Actualiza las horas lectivas:</label>
                                <input type="number" class="form-control" id="Actualizar_Hora_Lectiva" wire:model='actHoraLectiva' placeholder="En caso de no querer actualizarla, no escribir">
                                @error('actHoraLectiva')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <label for="Actualizar_Hora_Productiva" class="form-label h4 font-weight-normal">Actualiza las horas productivas:</label>
                                <input type="number" class="form-control" id="Actualizar_Hora_Productiva" wire:model='actHoraProductiva' placeholder="En caso de no querer actualizarla, no escribir">
                                @error('actHoraProductiva')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="updatePrograma">
                                <p class="form-label h4 font-weight-normal">Actualizar Competencias:</p>
                                @foreach ($competencias as $competencia)
                                    <div class="form-check mt-2">
                                        <label class="form-check-label h5">
                                            <input class="form-check-input" wire:model="CompetenciasPrograma" type="checkbox" name="rol" value="{{$competencia->codigo}}">{{$competencia->norma}}
                                        </label>
                                    </div>
                                @endforeach
                                @error('CompetenciasPrograma')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalUpdate" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" {{$mensajeExistente ? 'disabled' : ''}} wire:loading.class="disabled" wire:target="ActualizarPrograma" wire:click="ActualizarPrograma()">Actualizar información</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan
            
            @can('Curriculum.crear')
                <div class="modal fade" id="AgregarPrograma" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Programa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Seleccionar_programa" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                                <select class="form-control me-2" wire:model.live="programaAgregar" id="Seleccionar_programa">
                                    <option value="">Seleccione programa...</option>
                                    @foreach ($programas as $programa)
                                        <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                                    @endforeach
                                </select>
                                @error('programaAgregar')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>

                            <div wire:loading wire:target="programaAgregar" class="w-100 d-flex align-items-center justify-content-between">
                                <strong wire:loading wire:target="programaAgregar" role="status">Loading...</strong>
                                <div wire:loading wire:target="programaAgregar" class="spinner-border ms-auto" aria-hidden="true"></div>
                            </div>

                            @if ($programaAgregar != '' || $programaAgregar != null)
                                
                                <div class="mb-3" wire:loading.remove wire:target="programaAgregar">
                                    <label for="Ingresar_nivel" class="form-label h4 font-weight-normal">Escribe el nivel del programa:</label>
                                    <input type="text" class="form-control" id="Ingresar_nivel" wire:model.live='nivelAgregar' placeholder="Ejemplo: tecnico, tecnologo, etc">
                                    @error('nivelAgregar')
                                        <span>{{$message}}</span>
                                    @enderror
                                    @if ($mensajeExistente)
                                        <p class="text-danger">Este programa junto con este nivel ya existe</p>
                                    @endif
                                </div>

                                @if ($mensajeExistente == false)
                                    <div class="mb-3" wire:loading.remove wire:target="programaAgregar">
                                        <label for="Agregar_Fecha_Inicio" class="form-label h4 font-weight-normal">Agrega la fecha de inicio:</label>
                                        <input type="date" class="form-control" id="Agregar_Fecha_Inicio" wire:model='AgregarFechaInicio'>
                                        @error('AgregarFechaInicio')
                                            <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" wire:loading.remove wire:target="programaAgregar">
                                        <label for="Agregar_Fecha_Final" class="form-label h4 font-weight-normal">Agrega la fecha de finalización:</label>
                                        <input type="date" class="form-control" id="Agregar_Fecha_Final" wire:model='AgregarFechaFinal'>
                                        @error('AgregarFechaFinal')
                                            <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" wire:loading.remove wire:target="programaAgregar">
                                        <label for="Agregar_Hora_Lectiva" class="form-label h4 font-weight-normal">Agregar las horas lectivas:</label>
                                        <input type="number" class="form-control" id="Agregar_Hora_Lectiva" wire:model='AgregarHoraLectiva'>
                                        @error('AgregarHoraLectiva')
                                            <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" wire:loading.remove wire:target="programaAgregar">
                                        <label for="Agregar_Hora_Productiva" class="form-label h4 font-weight-normal">Agregar las horas productivas:</label>
                                        <input type="number" class="form-control" id="Agregar_Hora_Productiva" wire:model='AgregarHoraProductiva'>
                                        @error('AgregarHoraProductiva')
                                            <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3" wire:loading.remove wire:target="Programa, programaAgregar">
                                        <p class="form-label h4 font-weight-normal">Agregar Competencias:</p>
                                        @foreach ($competencias as $competencia)
                                            <div class="form-check mt-2">
                                                <label class="form-check-label h5">
                                                    <input class="form-check-input" wire:model="AgregarCompetencias" type="checkbox" name="rol" value="{{$competencia->codigo}}">{{$competencia->norma}}
                                                </label>
                                            </div>
                                        @endforeach
                                        @error('CompetenciasPrograma')
                                            <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalAgregar" data-dismiss="modal">Cerrar</button>
                        @if ($mensajeExistente)
                            <button type="button" class="btn btn-primary"  wire:click="RedireccionarPrograma()" data-dismiss="modal">Buscar Programa</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarPrograma, nivelAgregar, programaAgregar" wire:click="GuardarPrograma()">Guardar programa</button>
                        @endif
                        </div>
                    </div>
                    </div>
                </div>
            @endcan
            
        @else

            @can('Curriculum.editar')
                <div class="modal fade" id="ModificarDatos" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Dato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div wire:loading wire:target="ActualizarDato" class="w-100 d-flex align-items-center justify-content-between">
                                <strong wire:loading wire:target="ActualizarDato" role="status">Loading...</strong>
                                <div wire:loading wire:target="ActualizarDato" class="spinner-border ms-auto" aria-hidden="true"></div>
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarDato">
                                <label for="Actualizar_Dato" class="form-label h4 font-weight-normal">Actualiza el {{$opciones}}:</label>
                                <textarea class="form-control h4" id="Actualizar_Dato" wire:model='actDato'></textarea>
                                @error('actDato')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalActualizarDato" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="UpdateDato" wire:click="UpdateDato()">Actualizar {{$opciones}}</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan

            @can('Curriculum.crear')
                <div class="modal fade" id="AgregarDatos" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Dato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div wire:loading wire:target="AgregarDatoFuncion" class="w-100 d-flex align-items-center justify-content-between">
                                <strong wire:loading wire:target="AgregarDatoFuncion" role="status">Loading...</strong>
                                <div wire:loading wire:target="AgregarDatoFuncion" class="spinner-border ms-auto" aria-hidden="true"></div>
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="AgregarDatoFuncion">
                                <label for="Agregar_Dato" class="form-label h4 font-weight-normal">Agregar un {{$opciones}}:</label>
                                <textarea class="form-control h4" id="Agregar_Dato" wire:model='AgregarDato'></textarea>
                                @error('AgregarDato')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalAgregarDato" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="insertarDato" wire:click="insertarDato()">Guardar {{$opciones}}</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan
            
            @can('Curriculum.editar')
                <div class="modal fade" id="ActualizarCompetencia" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Competencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div wire:loading wire:target="ActualizarCompetencia" class="w-100 d-flex align-items-center justify-content-between">
                                <strong wire:loading wire:target="ActualizarCompetencia" role="status">Loading...</strong>
                                <div wire:loading wire:target="ActualizarCompetencia" class="spinner-border ms-auto" aria-hidden="true"></div>
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarCompetencia">
                                <label for="Actualizar_norma" class="form-label h4 font-weight-normal">Actualiza la norma / unidad de competencia:</label>
                                <textarea class="form-control h4" id="Actualizar_norma" wire:model='norma'></textarea>
                                @error('norma')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarCompetencia">
                                <label for="Actualizar_codigo" class="form-label h4 font-weight-normal">Actualiza el codigo de la competencia:</label>
                                <input type="number" class="form-control h4" id="Actualizar_codigo" wire:model='codigo'>
                                @error('codigo')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarCompetencia">
                                <label for="Actualizar_nombre" class="form-label h4 font-weight-normal">Actualiza el nombre de la competencia:</label>
                                <input type="text" class="form-control h4" id="Actualizar_nombre" wire:model='nombre'>
                                @error('nombre')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarCompetencia">
                                <label for="Actualizar_horas" class="form-label h4 font-weight-normal">Actualiza las horas de la competencia:</label>
                                <input type="number" class="form-control h4" id="Actualizar_horas" wire:model='horas'>
                                @error('horas')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3" wire:loading.remove wire:target="ActualizarCompetencia">
                                <p class="form-label h4 font-weight-normal">Actualizar programas:</p>
                                @foreach ($niveles as $nivel)
                                    <div class="form-check mt-2">
                                        <label class="form-check-label h5">
                                            <input class="form-check-input" wire:model="competenciasnivel" type="checkbox" name="nivel" value="{{$nivel->SlugInterno}}_{{$nivel->programa_id}}">{{$nivel->programa->NombrePrograma}}: {{$nivel->Nivel}}
                                        </label>
                                    </div>
                                @endforeach
                                @error('competenciasnivel')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalActualizarCompetencia" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="updateCompetencia" wire:click="updateCompetencia()">Actualizar competencia</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan

            @can('Curriculum.crear')
                <div class="modal fade" id="AgregarCompetencia" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Competencia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Agregar_norma" class="form-label h4 font-weight-normal">Agrega la norma / unidad de competencia:</label>
                                <textarea class="form-control h4" id="Agregar_norma" wire:model='NuevaNorma'></textarea>
                                @error('NuevaNorma')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Agregar_codigo" class="form-label h4 font-weight-normal">Agrega el codigo de la competencia:</label>
                                <input type="number" class="form-control h4" id="Agregar_codigo" wire:model='NuevoCodigo'>
                                @error('NuevoCodigo')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Agregar_nombre" class="form-label h4 font-weight-normal">Agrega el nombre de la competencia:</label>
                                <input type="text" class="form-control h4" id="Agregar_nombre" wire:model='NuevoNombre'>
                                @error('NuevoNombre')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="Agregar_horas" class="form-label h4 font-weight-normal">Agrega las horas de la competencia:</label>
                                <input type="number" class="form-control h4" id="Agregar_horas" wire:model='NuevaHora'>
                                @error('NuevaHora')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <p class="form-label h4 font-weight-normal">Agrega programas:</p>
                                @foreach ($niveles as $nivel)
                                    <div class="form-check mt-2">
                                        <label class="form-check-label h5">
                                            <input class="form-check-input" wire:model="NuevosNiveles" type="checkbox" name="nivel" value="{{$nivel->SlugInterno}}_{{$nivel->programa_id}}">{{$nivel->programa->NombrePrograma}}: {{$nivel->Nivel}}
                                        </label>
                                    </div>
                                @endforeach
                                @error('NuevosNiveles')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="ClosemodalAgregarCompetencia" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="guardarCompetencia" wire:click="guardarCompetencia()">Guardar competencia</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endcan
        @endif
    </div>
</div>

