<div>
    <p>Busqueda por: </p>
    <select class="form-control me-2" wire:model="for">
        <option value="name">Nombre</option>
        <option value="email">Correo electronico</option>
    </select>
    <label class="w-100">
        <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model="search">
    </label>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span>Mostrar </span>
            <select wire:model="registers">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <span>registros</span>
        </div>

        @livewire('users.crear-usuario')

    </div>

    @if ($users->count())
        <div class="table-responsive mt-2">
            <table class="table table-hover table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col" class="cursor-pointer align-middle" wire:click="order('id')" style="min-width: 100px">
                            Id
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif
                                
                            @endif 
                            
                        </th>
                        <th scope="col" class="cursor-pointer align-middle" wire:click="order('name')" style="min-width: 200px">
                            Nombre
                            @if ($sort == 'name')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif
                            
                            @endif 
                        </th>
                        <th scope="col" class="cursor-pointer align-middle" wire:click="order('email')">
                            Correo Electronico 
                            @if ($sort == 'email')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif          
                            @endif 
                        </th>
                        @can('Users.edit',)
                            <th scope="col">Opciones</th>                            
                        @elsecan('Users.destroy')
                            <th scope="col">Opciones</th>
                        @endcan
                    </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr {{($user->id == auth()->user()->id) ? 'class=bg-info' : '';}}>
                        <th scope="row" class="align-middle">{{$user->id}}</th>
                        <td class="align-middle">{{$user->name}}</td>
                        <td class="align-middle">{{$user->email}}</td>
                        @can('Users.edit',)
                        <td class="options">
                            @if ($user->id == auth()->user()->id)
                                <a class="btn btn-primary" href="{{route('settings')}}">Actualizar tu perfil</a> 
                            @else
                                @can('Users.edit')
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModificarUsuario" wire:click="update({{$user}})">Actualizar</button>
                                @endcan
                                @can('Users.destroy')
                                    <button class="btn btn-danger" wire:click="$emit('deleteUser', {{$user}})">Eliminar</button>
                                @endcan
                            @endif
                        </td>                            
                        @elsecan('Users.destroy')
                        <td class="options">
                            @if ($user->id == auth()->user()->id)
                                <a class="btn btn-primary" href="{{route('settings')}}">Actualizar tu perfil</a> 
                            @else
                                @can('Users.edit')
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModificarUsuario" wire:click="update({{$user}})">Actualizar</button>
                                @endcan
                                @can('Users.destroy')
                                    <button class="btn btn-danger" wire:click="$emit('deleteUser', {{$user}})">Eliminar</button>
                                @endcan
                            @endif
                        </td>
                        @endcan
                        
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div>
                {{$users->links()}}
            </div>
        @endif
        @can('Users.edit')
            
        <div class="modal fade" id="ModificarUsuario" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Actualizar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div wire:loading wire:target="update" class="w-100 d-flex align-items-center justify-content-between">
                        <strong wire:loading wire:target="update" role="status">Loading...</strong>
                        <div wire:loading wire:target="update" class="spinner-border ms-auto" aria-hidden="true"></div>
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="update">
                        <label for="Nombre_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza el nombre del usuario:</label>
                        <input type="text" class="form-control" id="Nombre_Usuario_Update" wire:model.defer='name'>
                        @error('name')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="update">
                        <label for="Email_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza el correo del usuario:</label>
                        <input type="email" class="form-control" id="Email_Usuario_Update" wire:model.defer='email'>
                        @error('email')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="update">
                        <label for="Contraseña_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza la contraseña:</label>
                        <input type="password" class="form-control" id="Contraseña_Usuario_Update" wire:model.defer='password' placeholder="En caso de no querer actualizarla, no escribir">
                        @error('password')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove wire:target="update">
                        <p class="form-label h4 font-weight-normal">Actualizar roles:</p>
                        @foreach ($roles as $role)
                        <div class="form-check">
                            <label class="form-check-label h5">
                                <input class="form-check-input" wire:model.defer="rolesUsuario" type="checkbox" name="rol" value="{{$role->id}}">{{$role->name}}
                            </label>
                          </div>
                        @endforeach
                        @error('rolesUsuario')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="ClosemodalUpdate" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="Actualizar" wire:click="Actualizar({{$ActRegister}})">Actualizar usuario</button>
                <span wire:loading wire:target="Actualizar">Cargando la actualizacion mi estimado :)</span>
                </div>
            </div>
            </div>
        </div>
        @endcan
    @else
        <h1>El usuario no se encontro :(</h1>
    @endif
    
</div>