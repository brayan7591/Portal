<div>
    <p class="h4 mb-2">Mostrar: </p>
    <select class="form-control me-2" wire:model.live="OpcionActual">
        <option value="Eventos">Eventos</option>
        <option value="Galeria">Galeria</option>
    </select>

    <div>
        <span>Mostrar </span>
        <select wire:model.live="registros">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </select>
        <span>registros</span>
    </div>

    <div wire:loading wire:target="OpcionActual" class="h4 w-100 d-flex align-items-center justify-content-between mt-3">
        <strong wire:loading wire:target="OpcionActual" role="status">Cargando...</strong>
        <div wire:loading wire:target="OpcionActual" class="spinner-border ms-auto" aria-hidden="true"></div>
    </div>

    <div wire:loading.remove wire:target="OpcionActual">
        @if ($OpcionActual == 'Eventos')
            <label class="h4 mb-2" for="nombre_evento_search">Busca por el nombre del evento:</label>
            <input type="text" class="form-control" name="nombre_evento_search" id="nombre_evento_search" wire:model.live="search">
        @else
            <label class="h4 mb-2" for="programa_formacion_search">Buscar por el programa de formacion:</label>
            <select class="form-control" name="programa_formacion_search" id="programa_formacion_search" wire:model.live="search">
                <option value="">Todos</option>
                @foreach ($programas as $programa)
                    <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                @endforeach
            </select>
        @endif
    </div>

    <div wire:loading wire:target="search" class="h4 w-100 d-flex align-items-center justify-content-between mt-3">
        <strong wire:loading wire:target="search" role="status">Cargando...</strong>
        <div wire:loading wire:target="search" class="spinner-border ms-auto" aria-hidden="true"></div>
    </div>

    <div wire:loading.remove wire:target="OpcionActual, search">
        
        @if ($OpcionActual == 'Eventos')
            @can('Eventos.crear')
                <div class="agregar_eventos">
                    <h3 class="text-center">Agrega un nuevo evento</h3>
                    <div class="mt-2">
                        <label for="nombre_evento" class="form-label h4 font-weight-normal">Nombre del evento:</label>
                        <input type="text" name="nombre_evento" id="nombre_evento" class="form-control" wire:model="NombreEvento">
                    </div>
                    @error('NombreEvento')
                        {{$message}}
                    @enderror
                    <div class="mt-2">
                        <label for="descripcion_evento" class="form-label h4 font-weight-normal">Descripcion del evento:</label>
                        <textarea name="descripcion_evento" id="descripcion_evento" class="form-control" cols="30" rows="10" wire:model="DescripcionEvento"></textarea>
                    </div>
                    @error('DescripcionEvento')
                        {{$message}}
                    @enderror
                    <div class="mt-2">
                        <label for="fecha_evento" class="form-label h4 font-weight-normal">Fecha y Hora del evento:</label>
                        <input type="datetime-local" class="form-control" id="fecha_evento" name="fecha_evento" wire:model="FechaEvento">
                    </div>
                    @error('FechaEvento')
                        {{$message}}
                    @enderror
                    <div class="mt-2">
                        <label for="programa_evento" class="form-label h4 font-weight-normal">Programa relacionado con el evento:</label>
                        <select name="programa_evento" id="programa_evento" class="form-control" wire:model="ProgramaEvento">
                            <option value="">Seleccione un programa de formación</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('ProgramaEvento')
                        {{$message}}
                    @enderror
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarEvento" wire:click="GuardarEvento">Agregar Evento</button>
                    </div>
                </div>
            @endcan
            @if ($eventos->count() > 0)
                @foreach ($eventos as $evento)
                    <div class="Mostrar_Evento">
                        <h3 class="text-center">{{$evento->nombre}}</h3>
                        <p>{{$evento->descripción}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>{{$evento->Fecha}}</p>
                            <p>{{$evento->programa->NombrePrograma}}</p>
                        </div>
                            
                        @can('Eventos.editar')
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#EditarEvento" wire:click="obtenerDatosEvento({{$evento->id}})">Actualizar Evento</button>
                                @can('Eventos.destruir')
                                    <button class="btn btn-danger" wire:click="$dispatch('deleteEvento', {{$evento->id}})">Eliminar Evento</button>
                                @endcan
                            </div>
                        @elsecan('Eventos.destruir')
                            <div class="d-flex justify-content-end align-items-center">
                                <button class="btn btn-danger" wire:click="$dispatch('deleteEvento', {{$evento->id}})">Eliminar Evento</button>
                            </div>
                        @endcan
                    </div> 
                @endforeach
                @can('Eventos.editar')
                    <div class="modal fade" id="EditarEvento" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" >
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div wire:loading wire:target="obtenerDatosEvento" class="w-100 d-flex align-items-center justify-content-between">
                                    <strong wire:loading wire:target="obtenerDatosEvento" role="status">Loading...</strong>
                                    <div wire:loading wire:target="obtenerDatosEvento" class="spinner-border ms-auto" aria-hidden="true"></div>
                                </div>
                                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosEvento">
                                    <label for="Actualizar_Nombre_Evento" class="form-label h4 font-weight-normal">Actualizar nombre del evento:</label>
                                    <input type="text" class="form-control" id="Actualizar_Nombre_Evento" wire:model='ActualizarNombreEvento'>
                                    @error('ActualizarNombreEvento')
                                        <span>
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosEvento">
                                    <label for="Actualizar_descripcion_Evento" class="form-label h4 font-weight-normal">Actualizar descripcion del Evento:</label>
                                    <textarea name="Actualizar_descripcion_Evento" id="Actualizar_descripcion_Evento" cols="30" rows="10" class="form-control" wire:model="ActualizarDescripcionEvento"></textarea>
                                    @error('ActualizarDescripcionEvento')
                                        <span>
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosEvento">
                                    <label for="Actualizar_Fecha_evento" class="form-label h4 font-weight-normal">Actualizar Fecha del Evento:</label>
                                    <input type="datetime-local" class="form-control" id="Actualizar_Fecha_evento" wire:model='ActualizarFechaEvento'>
                                    @error('ActualizarFechaEvento')
                                        <span>
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3" wire:loading.remove wire:target="obtenerDatosEvento">
                                    <label for="Actualizar_programa_evento" class="form-label h4 font-weight-normal">Actualizar programa relacionado con el evento:</label>
                                    <select class="form-control" name="Actualizar_programa_evento" id="Actualizar_programa_evento" wire:model="ActualizarProgramaEvento">
                                        <option value="">Seleccione un programa de formación</option>
                                        @foreach ($programas as $programa)
                                            <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                                        @endforeach
                                    </select>
                                    @error('ActualizarProgramaEvento')
                                        <span>
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="CloseActualizarEvento" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="obtenerDatosEvento, ActualizarEvento" wire:click="ActualizarEvento()">Actualizar Instructor</button>
                            </div>
                        </div>
                        </div>
                    </div>
                @endcan
                @if ($eventos->hasPages())
                    <div>
                        {{$eventos->links()}}
                    </div>
                @endif
            @else
                <div class="vacio">
                    Actualmente no hay eventos disponibles
                </div>
            @endif
            
        @else
            @can('Eventos.crear')
                <div class="Agregar_imagenes">
                    <h2 class="text-center">Agregar Nueva imagen</h2>
                    <div>
                        <label for="programa_imagen" class="form-label h4 font-weight-normal">Selecciona el programa de formacion</label>
                        <select class="form-control" name="programa_imagen" id="programa_imagen" wire:model.live="ProgramaImagen">
                            <option value="">Selecciona el programa de formación</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('ProgramaImagen')
                        {{$message}}
                    @enderror

                    <div>
                        <label for="Agregar_imagen" class="mt-3 form-label h4 font-weight-normal">Agrega una imagen</label>
                        <input type="file" class="form-control" name="Agregar_imagen" id="Agregar_imagen" wire:model="Imagen_agregar" accept="image/*">
                    </div>
                    
                    @error('Imagen_agregar')
                        {{$message}}
                    @enderror
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarImagen" wire:click="GuardarImagen">Agregar Imagen</button>
                    </div>
                </div>
            @endcan
            @if ($search == '')
                @foreach ($programas as $value => $programa)
                    <p class="h3 mt-3">Imagenes de {{$programa->NombrePrograma}}:</p>
                    
                    @if ($programa->imagenes->count() > 0)
                        <div class="imagenes">
                            @foreach ($programa->imagenes->take(4) as $value2 => $imagen)
                                <div class="contenedor_imagenes">    
                                    <img src="{{Storage::url($imagen->imagen)}}" alt="imagen_{{$value2}}">
                                    @can('Eventos.destruir')
                                        <button class="btn btn-danger boton_eliminar" wire:click="$dispatch('deleteImagen', {{$imagen->id}})"><i class="fa fa-trash"></i></button>
                                    @endcan
                                    @can('Eventos.editar')
                                        <div class="formulario">
                                            <div>
                                                <label for="Actualizar_imagen" class="form-label h4 font-weight-normal">Actualiza la imagen:</label>
                                                <input type="file" class="form-control" name="Actualizar_imagen" id="Actualizar_imagen" wire:model="Imagen_actualizar">
                                            </div>
                                            
                                            @error('Imagen_actualizar')
                                                {{$message}}
                                            @enderror

                                            <div class="d-flex justify-content-end mt-2">
                                                <button class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarImagen" wire:click="ActualizarImagen({{$imagen->id}})">Actualizar Imagen</button>
                                            </div>
                                            
                                        </div>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end my-2">
                            <button class="btn btn-primary" wire:click="$set('search', {{$programa->id}})">Mostrar todos</button>
                        </div>
                    @else
                        <div class="vacio">
                            No hay imagenes por el momento relacionados con el programa {{$programa->NombrePrograma}}
                        </div>
                    @endif
                @endforeach
            @else
                @if ($galeria->count() > 0)
                    <div class="imagenes mt-2">
                        @foreach ($galeria as $value3 => $imagenes)
                            <div class="contenedor_imagenes">
                                <img src="{{Storage::url($imagenes->imagen)}}" alt="imagen_{{$value3}}">
                                @can('Eventos.destruir')
                                    <button class="btn btn-danger boton_eliminar" wire:click="$dispatch('deleteImagen', {{$imagenes->id}})"><i class="fa fa-trash"></i></button>
                                @endcan
                                @can('Eventos.editar')
                                    <div class="formulario">
                                        <div>
                                            <label for="Actualizar_imagen" class="form-label h4 font-weight-normal">Actualiza la imagen:</label>
                                            <input type="file" class="form-control" name="Actualizar_imagen" id="Actualizar_imagen" wire:model="Imagen_actualizar">
                                        </div>
                                        
                                        @error('Imagen_actualizar')
                                            {{$message}}
                                        @enderror

                                        <div class="d-flex justify-content-end mt-2">
                                            <button class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarImagen" wire:click="ActualizarImagen({{$imagenes->id}})">Actualizar Imagen</button>
                                        </div>
                                        
                                    </div>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                    @if ($galeria->hasPages())
                        <div>
                            {{$galeria->links()}}
                        </div>
                    @endif
                @else
                    <div class="vacio">
                        No hay imagenes por el momento relacionadas a este programa
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>
