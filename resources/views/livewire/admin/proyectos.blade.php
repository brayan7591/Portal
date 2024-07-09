<div>
    <div class="mt-4">
        <label for="busqueda_programa" class="form-label h4 font-weight-normal">Busca por nombre, fecha de inicio o fecha de finalizacion del proyecto: </label>
        <input name="busqueda_programa" class="form-control" id="busqueda_programa" wire:model.live="search"></input>
    </div>
    <div class="mt-2 d-flex justify-content-between align-items-center">
        <div>
            <span>Mostrar </span>
            <select wire:model.live="registros">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <span>registros</span>
        </div>
        @can('Proyectos.crear')
            <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarProyecto">Agregar Proyecto</button>
        @endcan
    </div>
    @if ($proyectos->count() > 0)
        @foreach ($proyectos as $proyecto)
            <div class="proyecto">
                <h2 class="text-center">{{$proyecto->Nombre}}</h2>
                <div class="objetivo_proyecto">
                    <h3>Objetivo:</h3>
                    <p>{{$proyecto->Objetivo}}</p>
                </div>
                <div class="objetivo_justificacion">
                    <h3>Justificacion:</h3>
                    <p>{{$proyecto->Justificacion}}</p>
                </div>
                <div>
                    <h4>{{$proyecto->programa->NombrePrograma}} </h4>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p>{{$proyecto->FechaInicio}}</p>
                    <p>{{$proyecto->FechaFinalizacion}}</p>
                </div>
                @can('Proyectos.editar')
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary" id="modal" type="button" data-toggle="modal" data-target="#ActualizarProyecto" wire:click='obtenerDatosProyecto({{$proyecto->id}})' >Actualizar Proyecto</button>
                        @can('Proyectos.destruir')
                            <button class="btn btn-danger" wire:click="$dispatch('deleteproyecto', {{$proyecto->id}})">Eliminar Proyecto</button>
                        @endcan
                    </div>
                @elsecan('Proyectos.destruir')
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-danger" wire:click="$dispatch('deleteproyecto', {{$proyecto->id}})">Eliminar Proyecto</button>
                    </div>
                @endcan
                
            </div>
        @endforeach
        @if ($proyectos->hasPages())
            <div>
                {{$proyectos->links()}}
            </div>
        @endif
    @else
        <div class="proyectos_vacio">
            <h4>{{$search == '' ? 'No se encontraron proyectos' : 'No se encontro nada en la busqueda ' . $search}}</h4>
            @can('Proyectos.crear')
                <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarProyecto">Agregar Proyecto</button>
            @endcan
        </div>
    @endif
    @can('Proyectos.crear')
        <div class="modal fade" id="AgregarProyecto" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Proyecto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nombre_Proyecto" class="form-label h4 font-weight-normal">Nombre del proyecto:</label>
                        <input type="text" class="form-control" id="Nombre_Proyecto" wire:model='NombreProyecto' placeholder="Escribe el nombre del proyecto" required>
                        @error('NombreProyecto')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Objetivo_Proyecto" class="form-label h4 font-weight-normal">Objetivo del proyecto:</label>
                        <textarea name="Objetivo_Proyecto" id="Objetivo_Proyecto" class="form-control" cols="30" rows="10" wire:model="ObjetivoProyecto" placeholder="Escribe el objetivo del proyecto"></textarea>
                        @error('ObjetivoProyecto')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Justificacion_Proyecto" class="form-label h4 font-weight-normal">Justificacion del proyecto:</label>
                        <textarea name="Justificacion_Proyecto" id="Justificacion_Proyecto" class="form-control" cols="30" rows="10" wire:model="JustificacionProyecto" placeholder="Escribe la justificacion del proyecto"></textarea>
                        @error('JustificacionProyecto')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_Inicio_Proyecto" class="form-label h4 font-weight-normal">Fecha inicial del proyecto:</label>
                        <input type="date" class="form-control" id="Fecha_Inicio_Proyecto" wire:model='FechaInicialProyecto' placeholder="Digita la fecha inicial del proyecto" required>
                        @error('FechaInicialProyecto')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_Final_Proyecto" class="form-label h4 font-weight-normal">Fecha final del proyecto:</label>
                        <input type="date" class="form-control" id="Fecha_Final_Proyecto" wire:model='FechaFinalProyecto' placeholder="Digita la fecha final del proyecto" required>
                        @error('FechaFinalProyecto')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Seleccionar_programa_Proyecto" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ProgramaProyecto" id="Seleccionar_programa_Proyecto">
                            <option value="">Seleccione programa de formacion...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ProgramaProyecto')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseAgregarProyecto" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarProyecto" wire:click="GuardarProyecto()">Guardar Proyecto</button>
                </div>
            </div>
            </div>
        </div>
    @endcan
    @can('Proyectos.editar')
    <div class="modal fade" id="ActualizarProyecto" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Actualiza Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div wire:loading wire:target="obtenerDatosProyecto" class="w-100 d-flex align-items-center justify-content-between">
                    <strong wire:loading wire:target="obtenerDatosProyecto" role="status">Loading...</strong>
                    <div wire:loading wire:target="obtenerDatosProyecto" class="spinner-border ms-auto" aria-hidden="true"></div>
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_Nombre_Proyecto" class="form-label h4 font-weight-normal">Actualiza el nombre del proyecto:</label>
                    <input type="text" class="form-control" id="Actualizar_Nombre_Proyecto" wire:model='ActualizarNombreProyecto' placeholder="Escribe el nombre del proyecto" required>
                    @error('ActualizarNombreProyecto')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_Objetivo_Proyecto" class="form-label h4 font-weight-normal">Actualiza el objetivo del proyecto:</label>
                    <textarea name="Actualizar_Objetivo_Proyecto" id="Actualizar_Objetivo_Proyecto" class="form-control" cols="30" rows="10" wire:model="ActualizarObjetivoProyecto" placeholder="Escribe el objetivo del proyecto"></textarea>
                    @error('ActualizarObjetivoProyecto')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_Justificacion_Proyecto" class="form-label h4 font-weight-normal">Actualiza la justificacion del proyecto:</label>
                    <textarea name="Actualizar_Justificacion_Proyecto" id="Actualizar_Justificacion_Proyecto" class="form-control" cols="30" rows="10" wire:model="ActualizarJustificacionProyecto" placeholder="Escribe la justificacion del proyecto"></textarea>
                    @error('ActualizarJustificacionProyecto')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_Fecha_Inicio_Proyecto" class="form-label h4 font-weight-normal">Actualiza la fecha inicial del proyecto:</label>
                    <input type="date" class="form-control" id="Actualizar_Fecha_Inicio_Proyecto" wire:model='ActualizarFechaInicialProyecto' placeholder="Digita la fecha inicial del proyecto" required>
                    @error('ActualizarFechaInicialProyecto')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_Fecha_Final_Proyecto" class="form-label h4 font-weight-normal">Actualiza la fecha final del proyecto:</label>
                    <input type="date" class="form-control" id="Actualizar_Fecha_Final_Proyecto" wire:model='ActualizarFechaFinalProyecto' placeholder="Digita la fecha final del proyecto" required>
                    @error('ActualizarFechaFinalProyecto')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosProyecto">
                    <label for="Actualizar_programa_Proyecto" class="form-label h4 font-weight-normal">Actualiza el programa de formación:</label>
                    <select class="form-control me-2" wire:model="ActualizarProgramaProyecto" id="Actualizar_programa_Proyecto">
                        <option value="">Seleccione programa de formacion...</option>
                        @foreach ($programas as $programa)
                            <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                        @endforeach
                    </select>
                    @error('ActualizarProgramaProyecto')
                        <span>{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="CloseActualizarProyecto" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarProyecto" wire:click="ActualizarProyecto()">Actualizar Proyecto</button>
            </div>
        </div>
        </div>
    </div>
    @endcan
</div>
