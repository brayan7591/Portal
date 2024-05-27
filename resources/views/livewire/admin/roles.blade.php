<div>
    @can('Roles.crear')
        <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarRol">Agregar Rol</button>
    @endcan
    @if ($roles->count())
        <div class="table-responsive mt-2">
            <table class="table table-hover table-dark text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre del rol</th>
                        @can('Roles.editar',)
                            <th scope="col">Opciones</th>                            
                        @elsecan('Roles.destruir')
                            <th scope="col">Opciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{$rol->id}}</td>
                            <td>{{$rol->name}}</td>
                            @can('Roles.editar',)
                                <td class="options">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModificarRol" wire:click="ActualizandoVariables({{$rol}})">Actualizar</button>
                                    @can('Roles.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deleteRole', {{$rol}})">Eliminar</button>
                                    @endcan
                                </td>
                            @elsecan('Roles.destruir')
                                <td class="options">
                                    <button class="btn btn-danger" wire:click="$dispatch('deleteRole', {{$rol}}">Eliminar</button>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay roles por el momento F</p>
    @endif
    @can('Roles.crear')
        <div class="modal fade" id="AgregarRol" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Crear nuevo Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="Rol" class="form-label h4 font-weight-normal">Nombre del rol:</label>
                            <input type="text" class="form-control" name="rol" id="Rol" wire:model='AgregarRol'>
                            @error('AgregarRol')
                                <span>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <p class="form-label h4 font-weight-normal">Permisos del rol:</p>
                            
                            @foreach ($permisos as $value => $permiso)
                                @if (!($value == 0))
                                    <div class="form-check">
                                        <label class="form-check-label h5">
                                            <input class="form-check-input" type="checkbox" wire:model="AgregarPermisos" value="{{$permiso->id}}">{{$permiso->description}}
                                        </label>
                                    </div> 
                                    @if ($value % 4 == 0)
                                        <br>
                                    @endif
                                @endif
                            @endforeach

                            @error('AgregarPermisos')
                                <span>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosemodalAgregarRol" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:click="save">Crear Rol</button>
                </div>
            </div>
            </div>
        </div>
    @endcan

    @can('Roles.editar')
        <div class="modal fade" id="ModificarRol" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualiza el Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div wire:loading wire:target="ActualizandoVariables" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="ActualizandoVariables" role="status">Loading...</strong>
                        <div wire:loading wire:target="ActualizandoVariables" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                        <div class="mb-3" wire:loading.remove wire:target="ActualizandoVariables">
                            <label for="Actualizando_Rol" class="form-label h4 font-weight-normal">Actualiza el nombre del rol:</label>
                            <input type="text" class="form-control" name="Actualizando_Rol" id="Actualizando_Rol" wire:model='ActualizarRol'>
                            @error('ActualizarRol')
                                <span>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3" wire:loading.remove wire:target="ActualizandoVariables">
                            <p class="form-label h4 font-weight-normal">Actualiza los permisos del rol:</p>
                            
                            @foreach ($permisos as $value => $permiso)
                                @if (!($value == 0))
                                    <div class="form-check">
                                        <label class="form-check-label h5">
                                            <input class="form-check-input" type="checkbox" wire:model="ActualizarPermisos" value="{{$permiso->id}}">{{$permiso->description}}
                                        </label>
                                    </div> 
                                    @if ($value % 4 == 0)
                                        <br>
                                    @endif
                                @endif
                            @endforeach

                            @error('ActualizarPermisos')
                                <span>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="ClosemodalActualizarRol" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:click="Actualizar({{$Actualizando}})">Actualizar Rol</button>
                </div>
            </div>
            </div>
        </div>
    @endcan
</div>
