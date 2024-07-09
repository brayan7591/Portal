<div>
    <p class="h4 mb-2">Mostrar: </p>
    <select class="form-control me-2" wire:model.live="personaje">
        <option value="todos">Todos</option>
        <option value="aprendiz">Aprendices</option>
        <option value="egresado">Egresados</option>
    </select><br>
    <p class="h4 mb-2">Buscar por: </p>
    <select class="form-control me-2" wire:model.live="buscar">
        <option value="nombre">Nombre</option>
        <option value="correo">Correo</option>
        <option value="numero_ficha">Numero de Ficha</option>
        <option value="programa">Programa</option>
    </select>
    @if ($buscar == 'programa')
        <select class="form-control me-2" wire:model.live="search">
            <option value="" selected>Ninguno</option>
            @foreach ($programas as $programa)
                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
            @endforeach
        </select>
    @else
        <label class="w-100">
            <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model.live="search">
        </label>
    @endif
    
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span>Mostrar </span>
            <select wire:model.live="registros">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <span>registros</span>
        </div>

        @can('Destacados.crear')
            <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarPersonajeDestacado">Agregar un personaje destacado</button>
        @endcan
    </div>

    @if ($destacados->count())
        <div class="table-responsive mt-2">
            <table class="table table-hover table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col" class="align-middle" style="min-width: 100px">
                            Id
                        </th>
                        <th scope="col" class="align-middle" style="min-width: 200px">
                            Nombre
                        </th>
                        <th scope="col" class=" align-middle" style="min-width: 100px">
                            Correo Electronico
                        </th>
                        <th scope="col" class=" align-middle" style="min-width: 100px">
                            Imagen
                        </th>
                        <th scope="col" class="align-middle" style="min-width: 150px">
                            Numero Ficha
                        </th>
                        <th scope="col" class="align-middle" style="min-width: 200px">
                            Programa de Formación
                        </th>
                        <th scope="col" class="align-middle" style="min-width: 100px">
                            Rol
                        </th>
                        <th scope="col" class="align-middle" style="min-width: 500px">
                            motivo
                        </th>
                        @can('Destacados.editar')
                            <th scope="col" class="align-middle" style="min-width: 150px">Cambiar rol</th>
                            <th scope="col" class="align-middle">Opciones</th>
                        @elsecan('Destacados.destruir')
                            <th scope="col" class="align-middle">Opciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($destacados as $destacado)
                        <tr>
                            <th scope="row" class="align-middle">{{$destacado->id}}</th>
                            <td class="align-middle">{{$destacado->nombre}}</td>
                            <td class="align-middle">{{$destacado->correo}}</td>
                            <td class="align-middle">
                                @if ($destacado->imagen)
                                    <img src="{{Storage::url($destacado->imagen->url)}}" width="50px" height="50px" alt="Imagen de {{$destacado->nombre}}">
                                @else
                                    <img src="{{ asset('favicons/favicon.ico')}}" width="50px" height="50px" alt="Imagen de {{$destacado->nombre}}">
                                @endif
                            </td>
                            <td class="align-middle">{{$destacado->numero_ficha}}</td>
                            <td class="align-middle">{{$destacado->programa->NombrePrograma}}</td>
                            <td class="align-middle">{{$destacado->rol}}</td>
                            <td class="align-middle">{{$destacado->motivo}}</td>
                            @can('Destacados.editar')
                                <td class="align-middle">
                                    <button class="btn btn-primary mb-3" type="button" wire:loading.class="disabled" wire:target="CambiarRol" wire:click="CambiarRol({{$destacado->id}})">Cambiar a {{$destacado->rol == 'Aprendiz' ? 'Egresado' : 'Aprendiz'}}</button>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#ActualizarPersonajeDestacado" wire:click="obtener_datos({{$destacado->id}})">Actualizar</button>
                                    @can('Destacados.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deletePersonajes', {{$destacado->id}})">Eliminar</button>
                                    @endcan
                                </td>
                                
                            @elsecan('Destacados.destruir')
                                <td class="align-middle">
                                    <button class="btn btn-danger" wire:click="$dispatch('deleteUser', {{$destacado->id}})">Eliminar</button>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="mt-2 bg-black d-flex flex-column gap-2 justify-content-center align-items-center" style="width: 100%; height:200px">
            <h3>No se encontraron Personajes destacados. </h3>
            @can('Destacados.crear')
                <button class="btn btn-primary mt-2" id="modal" type="button" data-toggle="modal" data-target="#AgregarPersonajeDestacado">Agregar Personaje</button>
            @endcan
        </div>
    @endif
    @if ($destacados->hasPages())
        <div>
            {{$destacados->links()}}
        </div>
    @endif

    @can('Destacados.crear')
        <div class="modal fade" id="AgregarPersonajeDestacado" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar un personaje destacado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nombre_Personaje_Destacado" class="form-label h4 font-weight-normal">Nombre del Aprendiz o Egresado:</label>
                        <input type="text" class="form-control" id="Nombre_Personaje_Destacado" wire:model='NombrePersonajeDestacado' placeholder="Escribe el nombre del personaje destacado" required>
                        @error('NombrePersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Correo_Personaje_Destacado" class="form-label h4 font-weight-normal">Correo del Aprendiz o Egresado:</label>
                        <input type="email" class="form-control" id="Correo_Personaje_Destacado" wire:model='CorreoPersonajeDestacado' placeholder="Escribe el correo electronico del personaje destacado" required>
                        @error('CorreoPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Ficha_Personaje_Destacado" class="form-label h4 font-weight-normal">Numero de la ficha del Aprendiz o Egresado (opcional):</label>
                        <input type="number" class="form-control" id="Ficha_Personaje_Destacado" wire:model='FichaPersonajeDestacado' placeholder="Digita el numero de la ficha relacionada con el aprendiz o egresado" required>
                        @error('FichaPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Motivo_Personaje_Destacado" class="form-label h4 font-weight-normal">Motivo de que el Aprendiz o Egresado sea destacado:</label>
                        <textarea class="form-control" name="Motivo_Personaje_Destacado" id="Motivo_Personaje_Destacado" wire:model='MotivoPersonajeDestacado' cols="30" rows="10" placeholder="Escribe el motivo de porque el Aprendiz/Egresado es destacado"></textarea>
                        @error('MotivoPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Seleccionar_programa_Personaje_Destacado" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ProgramaPersonajeDestacado" id="Seleccionar_programa_Personaje_Destacado">
                            <option value="">Seleccione programa de formacion...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ProgramaPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Rol_Personaje_Destacado" class="form-label h4 font-weight-normal">Seleccione el rol del personaje destacado:</label>
                        <select class="form-control me-2" wire:model="RolPersonajeDestacado" id="Rol_Personaje_Destacado">
                            <option value="">Seleccione el rol del personaje destacado</option>
                            <option value="Aprendiz">Aprendiz</option>
                            <option value="Egresado">Egresado</option>
                        </select>
                        @error('RolPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Imagen_Personaje_Destacado" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Imagen_Personaje_Destacado" wire:model.live='imagenPersonajeDestacado' accept="image/*">
                        @error('imagenPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="imagenPersonajeDestacado" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="imagenPersonajeDestacado" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="imagenPersonajeDestacado" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    @if ($imagenPersonajeDestacado)
                        <div class="d-flex justify-content-center">
                            <div>
                                <img src="{{$imagenPersonajeDestacado->temporaryUrl()}}" height="200px" width="200px" alt="imagen de vocero">
                            </div>
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" wire:click="$set('imagenPersonajeDestacado', '')">Quitar imagen</button>
                        </div>
                    @endif
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseAgregarPersonajeDestacado" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarPersonajeDestacado, imagenPersonajeDestacado" wire:click="GuardarPersonajeDestacado()">Guardar Aprendiz/Egresado</button>
                </div>
            </div>
            </div>
        </div>
    @endcan

    @can('Destacados.editar')
        <div class="modal fade" id="ActualizarPersonajeDestacado" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizar el personaje destacado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div wire:loading wire:target="obtener_datos" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="obtener_datos" role="status">Loading...</strong>
                        <div wire:loading wire:target="obtener_datos" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Nombre_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualizar el nombre del {{$ActualizarRolPersonajeDestacado}}:</label>
                        <input type="text" class="form-control" id="Actualizar_Nombre_Personaje_Destacado" wire:model='ActualizarNombrePersonajeDestacado' placeholder="Escribe el nombre del personaje destacado" required>
                        @error('ActualizarNombrePersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Correo_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualiza el correo del {{$ActualizarRolPersonajeDestacado}}:</label>
                        <input type="email" class="form-control" id="Actualizar_Correo_Personaje_Destacado" wire:model='ActualizarCorreoPersonajeDestacado' placeholder="Escribe el correo electronico del personaje destacado" required>
                        @error('ActualizarCorreoPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Ficha_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualiza el numero de la ficha del {{$ActualizarRolPersonajeDestacado}}:</label>
                        <input type="number" class="form-control" id="Actualizar_Ficha_Personaje_Destacado" wire:model='ActualizarFichaPersonajeDestacado' placeholder="Digita el numero de la ficha relacionada con el aprendiz o egresado" required>
                        @error('ActualizarFichaPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Motivo_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualiza el motivo de que el {{$ActualizarRolPersonajeDestacado}} sea destacado:</label>
                        <textarea class="form-control" name="Actualizar_Motivo_Personaje_Destacado" id="Actualizar_Motivo_Personaje_Destacado" wire:model='ActualizarMotivoPersonajeDestacado' cols="30" rows="10" placeholder="Escribe el motivo de porque el Aprendiz/Egresado es destacado"></textarea>
                        @error('ActualizarMotivoPersonajeDestacado')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_programa_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualiza el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ActualizarProgramaPersonajeDestacado" id="Actualizar_programa_Personaje_Destacado">
                            <option value="">Seleccione programa de formacion...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ActualizarProgramaPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Rol_Personaje_Destacado" class="form-label h4 font-weight-normal">Actualiza el rol del {{$ActualizarRolPersonajeDestacado}}:</label>
                        <select class="form-control me-2" wire:model="ActualizarRolPersonajeDestacado" id="Actualizar_Rol_Personaje_Destacado">
                            <option value="">Seleccione el rol del personaje destacado</option>
                            <option value="Aprendiz">Aprendiz</option>
                            <option value="Egresado">Egresado</option>
                        </select>
                        @error('ActualizarRolPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtener_datos">
                        <label for="Actualizar_Imagen_Personaje_Destacado" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Actualizar_Imagen_Personaje_Destacado" wire:model.live='ActualizarimagenPersonajeDestacado' accept="image/*">
                        @error('ActualizarimagenPersonajeDestacado')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="ActualizarimagenPersonajeDestacado" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarimagenPersonajeDestacado" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="ActualizarimagenPersonajeDestacado" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div wire:loading wire:target="ActualizarImagenPersonajeDestacadoActual" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarImagenPersonajeDestacadoActual" role="status">Quitando imagen...</strong>
                        <div wire:loading wire:target="ActualizarImagenPersonajeDestacadoActual" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>

                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtener_datos">
                        @if ($ActualizarImagenPersonajeDestacadoActual)
                            <div class="imagen_temporal">
                                <img src="{{Storage::url($ActualizarImagenPersonajeDestacadoActual)}}" height="200px" width="200px" alt="imagen de personaje destacado">
                            </div>
                        @else
                            @if ($ActualizarimagenPersonajeDestacado)
                                <div class="imagen_temporal">
                                    <img src="{{$ActualizarimagenPersonajeDestacado->temporaryUrl()}}" height="200px" width="200px" alt="imagen de personaje destacado">
                                </div>
                            @endif
                        @endif
                    </div><br>
                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtener_datos">
                        @if ($ActualizarImagenPersonajeDestacadoActual)
                            <button class="btn btn-primary" wire:click="$set('ActualizarImagenPersonajeDestacadoActual', '')">Quitar imagen</button>
                        @else
                            @if ($ActualizarimagenPersonajeDestacado)
                                <button class="btn btn-primary" wire:click="$set('ActualizarimagenPersonajeDestacado', '')">Quitar imagen</button>
                            @endif
                        @endif
                    </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseActualizarPersonajeDestacado" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarImagenPersonajeDestacadoActual, ActualizarPersonajeDestacado, obtener_datos, ActualizarimagenPersonajeDestacado" wire:click="ActualizarPersonajeDestacado()">Actualizar Aprendiz/Egresado</button>
                </div>
            </div>
            </div>
        </div>
    @endcan
</div>
