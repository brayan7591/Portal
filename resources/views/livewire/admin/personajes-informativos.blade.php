<div>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Voceros:</h2>
        @can('Informativos.crear')
            <button class="btn btn-primary mb-2" id="modal" type="button" data-toggle="modal" data-target="#AgregarInstructor">Agregar Vocero</button>
        @endcan
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Instructores:</h2>
        @can('Informativos.crear')
            <button class="btn btn-primary mb-2" id="modal" type="button" data-toggle="modal" data-target="#AgregarInstructor">Agregar Instructor</button>
        @endcan
    </div>

    @if ($instructores->count() > 0)
        <div class="instructores">
            @foreach ($instructores as $instructor)
                <div class="tarjeta">
                    <div class="tmodal">
                        <div class="pagina inicial">
                            <div class="imagen ml-2">
                                @if ($instructor->imagen)
                                    <img src="{{Storage::url($instructor->imagen->url)}}" alt="Imagen de {{$instructor->Nombre}}">
                                @else
                                    <img src="{{ asset('favicons/favicon.ico') }}" alt="Imagen de {{$instructor->Nombre}}">
                                @endif
                            </div>
                            <div class="texto-informativo">
                                <h3 class="text-success">{{$instructor->Nombre}}</h3>
                                <p>Especialidad: {{$instructor->Especialidad}}</p>
                                <p>Numero telefonico: {{$instructor->Telefono}}</p>
                                <p>Correo Electronico: {{$instructor->Email}}</p>
                                <p>Programa de Formacion: {{$instructor->programa->NombrePrograma}}</p>
                                <p>Jornada: {{$instructor->jornada}}</p>
                            </div>
                        </div>
                        <div class="pagina descripcion p-2">
                            <p>{{$instructor->Descripcion}}</p>
                        </div>
                    </div>
                    @can('Informativos.editar')
                        <div class="opciones">
                            <button class="btn btn-primary" class="btn btn-primary" id="modal" type="button" data-toggle="modal" data-target="#EditarInstructor" wire:click="obtenerDatos({{$instructor->id}})">Actualizar Instructor</button>
                            @can('Informativos.destruir')
                                <button class="btn btn-danger" wire:click="$dispatch('deleteInstructor', {{$instructor->id}})">Borrar Instructor</button>
                            @endcan
                        </div>
                    @elsecan('Informativos.destruir')
                        <div class="opciones">
                            <button class="btn btn-danger" wire:click="$dispatch('deleteInstructor', {{$instructor->id}})">Borrar Instructor</button>
                        </div>
                    @endcan
                </div>
            @endforeach
        </div>
    @else
        <div class="no-instructores bg-dark">
            <h3 class="text-center">Actualmente no hay instructores en la base de datos :(</h3>
            @can('Informativos.crear')
                <button class="btn btn-primary" id="modal" type="button" data-toggle="modal" data-target="#AgregarInstructor">Agregar Instructor</button>
            @endcan
        </div>
    @endif
    @can('Informativos.crear')
        <div class="modal fade" id="AgregarInstructor" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Instructor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nombre_Instructor" class="form-label h4 font-weight-normal">Nombre del instructor:</label>
                        <input type="text" class="form-control" id="Nombre_Instructor" wire:model='NombreInstructor' placeholder="Escribe el nombre del instructor" required>
                        @error('NombreInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Email_Instructor" class="form-label h4 font-weight-normal">Correo del instructor:</label>
                        <input type="email" class="form-control" id="Email_Instructor" wire:model='CorreoInstructor' placeholder="Escribe el correo electronico del instructor" required>
                        @error('CorreoInstructor')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Especialidad_Instructor" class="form-label h4 font-weight-normal">Especialidad:</label>
                        <input type="text" class="form-control" id="Especialidad_Instructor" wire:model='EspecialidadInstructor' placeholder="Escribe la especialidad del instructor" required>
                        @error('EspecialidadInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Telefono_Instructor" class="form-label h4 font-weight-normal">Telefono:</label>
                        <input type="tel" class="form-control" id="Telefono_Instructor" wire:model='TelefonoInstructor' placeholder="Escribe el telefono de contacto del instructor">
                        @error('TelefonoInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion_Instructor" class="form-label h4 font-weight-normal">Descripcion:</label>
                        <textarea class="form-control" id="Descripcion_Instructor" cols="30" rows="10" wire:model='DescripcionInstructor' placeholder="Escribe una descripcion del instructor"></textarea>
                        @error('DescripcionInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Seleccionar_programa" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ProgramaInstructor" id="Seleccionar_programa">
                            <option value="">Seleccione programa...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ProgramaInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Seleccionar_Jornada" class="form-label h4 font-weight-normal">Seleccione la jornada habilitada:</label>
                        <select class="form-control me-2" wire:model="JornadaInstructor" id="Seleccionar_Jornada">
                            <option value="">Seleccione Jornada...</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                            <option value="mixta">Mixta</option>
                            <option value="nocturna">Nocturna</option>
                        </select>
                        @error('JornadaInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Imagen_instructor" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Imagen_instructor" wire:model.live='imagenInstructor' accept="image/*">
                        @error('imagenInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    @if ($imagenInstructor)
                    <div class="d-flex justify-content-center">
                        <div class="imagen_temporal">
                            <img src="{{$imagenInstructor->temporaryUrl()}}" alt="">
                        </div>
                    </div>
                    @endif
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseAgregarInstructor" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarInstructor, imagenInstructor" wire:click="GuardarInstructor()">Guardar Instructor</button>
                </div>
            </div>
            </div>
        </div>
    @endcan
    @can('Informativos.editar')
        <div class="modal fade" id="EditarInstructor" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Instructor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div wire:loading wire:target="obtenerDatos" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="obtenerDatos" role="status">Loading...</strong>
                        <div wire:loading wire:target="obtenerDatos" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Nombre_Instructor" class="form-label h4 font-weight-normal">Actualizar nombre del instructor:</label>
                        <input type="text" class="form-control" id="Actualizar_Nombre_Instructor" wire:model='ActualizarNombreInstructor'>
                        @error('ActualizarNombreInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Email_Instructor" class="form-label h4 font-weight-normal">Actualizar correo del instructor:</label>
                        <input type="email" class="form-control" id="Actualizar_Email_Instructor" wire:model='ActualizarCorreoInstructor'>
                        @error('ActualizarCorreoInstructor')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Especialidad_Instructor" class="form-label h4 font-weight-normal">Actualizar especialidad:</label>
                        <input type="text" class="form-control" id="Actualizar_Especialidad_Instructor" wire:model='ActualizarEspecialidadInstructor'>
                        @error('ActualizarEspecialidadInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Telefono_Instructor" class="form-label h4 font-weight-normal">Actualizar telefono:</label>
                        <input type="tel" class="form-control" id="Actualizar_Telefono_Instructor" wire:model='ActualizarTelefonoInstructor'>
                        @error('ActualizarTelefonoInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Descripcion_Instructor" class="form-label h4 font-weight-normal">Actualizar descripcion:</label>
                        <textarea class="form-control" id="Actualizar_Descripcion_Instructor" cols="30" rows="10" wire:model='ActualizarDescripcionInstructor'></textarea>
                        @error('ActualizarDescripcionInstructor')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Seleccionar_programa" class="form-label h4 font-weight-normal">Actualizar programa de formación:</label>
                        <select class="form-control me-2" wire:model="ActualizarProgramaInstructor" id="Actualizar_Seleccionar_programa">
                            <option value="">Seleccione programa...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ActualizarProgramaInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Jornada" class="form-label h4 font-weight-normal">Actualizar jornada:</label>
                        <select class="form-control me-2" wire:model="ActualizarJornadaInstructor" id="Actualizar_Jornada">
                            <option value="">Seleccione Jornada...</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                            <option value="mixta">Mixta</option>
                            <option value="nocturna">Nocturna</option>
                        </select>
                        @error('ActualizarJornadaInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseActualizarInstructor" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarInstructor, obtenerDatos" wire:click="ActualizarInstructor()">Actualizar Instructor</button>
                </div>
            </div>
            </div>
        </div>
    @endcan
</div>