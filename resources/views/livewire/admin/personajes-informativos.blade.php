<div>
    <!-- Voceros -->

    <div class="d-flex justify-content-between align-items-center">
        <h2>Voceros:</h2>
        @can('Informativos.crear')
            <button class="btn btn-primary mb-2" id="modal" type="button" data-toggle="modal" data-target="#AgregarVocero">Agregar Vocero</button>
        @endcan
    </div>

    @if ($voceros->count() > 0)
        <div class="contenedor-voceros">
            @foreach ($voceros as $vocero)
                <div class="Voceros">
                    <div class="informacion">
                        @if ($vocero->imagen)
                            <img src="{{Storage::url($vocero->imagen->url)}}" alt="Imagen de {{$vocero->Nombre}}" onclick="this.parentElement.classList.toggle('active')">
                        @else
                            <img src="{{ asset('favicons/favicon.ico') }}" alt="Imagen de {{$vocero->Nombre}}" onclick="this.parentElement.classList.toggle('active')">
                        @endif
                        <div class="informacion-vocero">
                            <h3>{{$vocero->Nombre}}</h3>
                            <p class="text-info">Correo: <span class="text-white">{{$vocero->Email}}</span></p>
                            <p class="text-info">Numero de ficha: <span class="text-white">{{$vocero->NoFicha}}</span></p>
                            <p class="text-info">Programa: <span class="text-white">{{$vocero->programa->NombrePrograma}}</span></p>
                            @can('Informativos.editar')
                                <button class="btn btn-primary editar-vocero" type="button" data-toggle="modal" data-target="#EditarVocero" wire:click="obtenerDatosVoceros({{$vocero->id}})"><i class="fa fa-pen"></i></button>
                            @endcan
                            @can('Informativos.destruir')
                                <button class="btn btn-danger eliminar-vocero" wire:click="$dispatch('deletevocero', {{$vocero->id}})"><i class="fa fa-trash"></i></button>
                            @endcan
                        </div>
                    </div>
                    <h3 class="text-center mt-2">{{$vocero->Nombre}}</h3>
                </div>
            @endforeach

            @can('Informativos.crear')
                <div class="Agregar-vocero">
                    <div class="boton-agregar-vocero" type="button" data-toggle="modal" data-target="#AgregarVocero"><i class="fas fa-fw fa-plus"></i></div>
                </div>
            @endcan
        </div>
        @if ($voceros->hasPages())
            <div>
                {{$voceros->links()}}
            </div>
        @endif
    @else
        <div class="no-voceros bg-dark mb-2">
            <h3 class="text-center">Actualmente no hay voceros en la base de datos :(</h3>
            @can('Informativos.crear')
                <button class="btn btn-primary" id="modal" type="button" data-toggle="modal" data-target="#AgregarVocero">Agregar vocero</button>
            @endcan
        </div>
    @endif

    <!-- Instructores -->
    
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
                                <p>Jornada: {{ucfirst(strtolower($instructor->jornada))}}</p>
                            </div>
                        </div>
                        <div class="pagina descripcion p-2">
                            <h3 class="text-center text-black p-2">{{$instructor->Nombre}}</h3>
                            <p class="text-dark h5">{{$instructor->Descripcion}}</p>
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

        @if ($instructores->hasPages())
            <div>
                {{$instructores->links()}}
            </div>
        @endif

    @else
        <div class="no-instructores bg-dark">
            <h3 class="text-center">Actualmente no hay instructores en la base de datos :(</h3>
            @can('Informativos.crear')
                <button class="btn btn-primary" id="modal" type="button" data-toggle="modal" data-target="#AgregarInstructor">Agregar Instructor</button>
            @endcan
        </div>
    @endif

    @can('Informativos.crear')

        <!-- Modal de Agregar vocero -->
        <div class="modal fade" id="AgregarVocero" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Vocero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Nombre_Vocero" class="form-label h4 font-weight-normal">Nombre del vocero:</label>
                        <input type="text" class="form-control" id="Nombre_Vocero" wire:model='NombreVocero' placeholder="Escribe el nombre del vocero" required>
                        @error('NombreVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Email_Vocero" class="form-label h4 font-weight-normal">Correo del vocero:</label>
                        <input type="email" class="form-control" id="Email_Vocero" wire:model='CorreoVocero' placeholder="Escribe el correo electronico del vocero" required>
                        @error('CorreoVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Ficha_vocero" class="form-label h4 font-weight-normal">Numero de la ficha encargado:</label>
                        <input type="number" class="form-control" id="Ficha_vocero" wire:model='FichaVocero' placeholder="Digita el numero de la ficha relacionada" required>
                        @error('FichaVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Seleccionar_programa_vocero" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ProgramaVocero" id="Seleccionar_programa_vocero">
                            <option value="">Seleccione programa de formacion...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ProgramaVocero')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Imagen_Vocero" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Imagen_Vocero" wire:model.live='imagenVocero' accept="image/*">
                        @error('imagenVocero')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="imagenVocero" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="imagenVocero" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="imagenVocero" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    @if ($imagenVocero)
                        <div class="d-flex justify-content-center">
                            <div class="imagen_temporal">
                                <img src="{{$imagenVocero->temporaryUrl()}}" alt="imagen de vocero">
                            </div>
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" wire:click="$set('imagenVocero', '')">Quitar imagen</button>
                        </div>
                    @endif
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseAgregarVocero" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="GuardarVocero, imagenVocero" wire:click="GuardarVocero()">Guardar Vocero</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal de Agregar instructor -->
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
                    <div wire:loading wire:target="imagenInstructor" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="imagenInstructor" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="imagenInstructor" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    @if ($imagenInstructor)
                        <div class="d-flex justify-content-center">
                            <div class="imagen_temporal">
                                <img src="{{$imagenInstructor->temporaryUrl()}}" alt="imagen de instructor">
                            </div>
                        </div><br>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary" wire:click="$set('imagenInstructor', '')">Quitar imagen</button>
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

        <!-- Modal para actualizar instructor -->
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
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatos">
                        <label for="Actualizar_Imagen_instructor" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Actualizar_Imagen_instructor" wire:model.live='ActualizarImagenInstructor' accept="image/*">
                        @error('ActualizarImagenInstructor')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="ActualizarImagenInstructor" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarImagenInstructor" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="ActualizarImagenInstructor" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div wire:loading wire:target="ActualizarImagenInstructorActual" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarImagenInstructorActual" role="status">Quitando imagen...</strong>
                        <div wire:loading wire:target="ActualizarImagenInstructorActual" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>

                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtenerDatos">
                        @if ($ActualizarImagenInstructorActual)
                            <div class="imagen_temporal">
                                <img src="{{Storage::url($ActualizarImagenInstructorActual)}}" alt="imagen de instructor">
                            </div>
                        @else
                            @if ($ActualizarImagenInstructor)
                                <div class="imagen_temporal">
                                    <img src="{{$ActualizarImagenInstructor->temporaryUrl()}}" alt="imagen de instructor">
                                </div>
                            @endif
                        @endif
                    </div><br>
                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtenerDatos">
                        @if ($ActualizarImagenInstructorActual)
                            <button class="btn btn-primary" wire:click="$set('ActualizarImagenInstructorActual', '')">Quitar imagen</button>
                        @else
                            @if ($ActualizarImagenInstructor)
                                <button class="btn btn-primary" wire:click="$set('ActualizarImagenInstructor', '')">Quitar imagen</button>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseActualizarInstructor" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarImagenInstructor, ActualizarInstructor, obtenerDatos" wire:click="ActualizarInstructor()">Actualizar Instructor</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal para actualizar vocero -->
        <div class="modal fade" id="EditarVocero" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Vocero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div wire:loading wire:target="obtenerDatosVoceros" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="obtenerDatosVoceros" role="status">Loading...</strong>
                        <div wire:loading wire:target="obtenerDatosVoceros" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatosVoceros">
                        <label for="Actualizar_Nombre_Vocero" class="form-label h4 font-weight-normal">Actualiza el nombre del vocero:</label>
                        <input type="text" class="form-control" id="Actualizar_Nombre_Vocero" wire:model='ActualizarNombreVocero' placeholder="Actualiza el nombre del vocero" required>
                        @error('ActualizarNombreVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatosVoceros">
                        <label for="Actualizar_Email_Vocero" class="form-label h4 font-weight-normal">Actualiza el correo del vocero:</label>
                        <input type="email" class="form-control" id="Actualizar_Email_Vocero" wire:model='ActualizarCorreoVocero' placeholder="Actualiza el correo electronico del vocero" required>
                        @error('ActualizarCorreoVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatosVoceros">
                        <label for="Actualizar_Ficha_vocero" class="form-label h4 font-weight-normal">Actualiza el numero de la ficha encargado:</label>
                        <input type="number" class="form-control" id="Actualizar_Ficha_vocero" wire:model='ActualizarFichaVocero' placeholder="Actualiza el numero de la ficha relacionada" required>
                        @error('ActualizarFichaVocero')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatosVoceros">
                        <label for="Seleccionar_programa_vocero_actualizar" class="form-label h4 font-weight-normal">Seleccione el programa de formación:</label>
                        <select class="form-control me-2" wire:model="ActualizarProgramaVocero" id="Seleccionar_programa_vocero_actualizar">
                            <option value="">Actualiza el programa de formacion...</option>
                            @foreach ($programas as $programa)
                                <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                            @endforeach
                        </select>
                        @error('ActualizarProgramaVocero')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="obtenerDatosVoceros">
                        <label for="Actualizar_Imagen_instructor" class="form-label h4 font-weight-normal">Adjunta una imagen de perfil (opcional):</label>
                        <input type="file" class="form-control" id="Actualizar_Imagen_instructor" wire:model.live='ActualizarImagenVocero' accept="image/*">
                        @error('ActualizarImagenVocero')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div wire:loading wire:target="ActualizarImagenVocero" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarImagenVocero" role="status">Cargando imagen...</strong>
                        <div wire:loading wire:target="ActualizarImagenVocero" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div wire:loading wire:target="ActualizarImagenVoceroActual" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizarImagenVoceroActual" role="status">Quitando imagen...</strong>
                        <div wire:loading wire:target="ActualizarImagenVoceroActual" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>

                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtenerDatosVoceros">
                        @if ($ActualizarImagenVoceroActual)
                            <div class="imagen_temporal">
                                <img src="{{Storage::url($ActualizarImagenVoceroActual)}}" alt="imagen de instructor">
                            </div>
                        @else
                            @if ($ActualizarImagenVocero)
                                <div class="imagen_temporal">
                                    <img src="{{$ActualizarImagenVocero->temporaryUrl()}}" alt="imagen de instructor">
                                </div>
                            @endif
                        @endif
                    </div><br>
                    <div class="d-flex justify-content-center" wire:loading.class.remove="d-flex" wire:loading.class="d-none" wire:target="obtenerDatosVoceros">
                        @if ($ActualizarImagenVoceroActual)
                            <button class="btn btn-primary" wire:click="set$('ActualizarImagenVoceroActual', '')">Quitar imagen</button>
                        @else
                            @if ($ActualizarImagenVocero)
                                <button class="btn btn-primary" wire:click="$set('ActualizarImagenVocero', '')">Quitar imagen</button>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CloseActualizarVocero" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="ActualizarVocero, ActualizarImagenVocero, obtenerDatosVoceros" wire:click="ActualizarVocero()">Actualizar Vocero</button>
                </div>
            </div>
            </div>
        </div>

    @endcan
</div>