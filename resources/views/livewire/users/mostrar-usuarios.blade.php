<div>
    <p>Busqueda por: </p>
    <select class="form-control me-2" wire:model="for">
        <option value="name">Nombre</option>
        <option value="email">Correo electronico</option>
    </select>
    <label class="w-100">
        <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model="search">
    </label>

    @livewire('users.crear-usuario')

    @if ($users->count())
        <div class="table-responsive mt-2">
            <table class="table table-hover table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col" class="cursor-pointer" wire:click="order('id')">
                            Id
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif
                                
                            @endif 
                            
                        </th>
                        <th scope="col" class="cursor-pointer" wire:click="order('name')">
                            Nombre
                            @if ($sort == 'name')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif
                            
                            @endif 
                        </th>
                        <th scope="col" class="cursor-pointer" wire:click="order('email')">
                            Correo Electronico 
                            @if ($sort == 'email')
                                @if ($direction == 'asc')
                                    <i class="fas fa fa-home"></i>
                                @else
                                    <i class="fa fa-laptop-code"></i>
                                @endif          
                            @endif 
                        </th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModificarUsuario" wire:click="update({{$user->id}})">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
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
                    <h2 wire:loading class="text-center">Cargando ...</h2>
                    <div class="mb-3" wire:loading.remove>
                        <label for="Nombre_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza el nombre del usuario:</label>
                        <input type="text" class="form-control" id="Nombre_Usuario_Update" wire:model.defer='ActName'>
                        @error('ActName')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove>
                        <label for="Email_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza el correo del usuario:</label>
                        <input type="email" class="form-control" id="Email_Usuario_Update" wire:model.defer='ActEmail'>
                        @error('ActEmail')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3" wire:loading.remove>
                        <label for="Contraseña_Usuario_Update" class="form-label h4 font-weight-normal">Actualiza la contraseña:</label>
                        <input type="password" class="form-control" id="Contraseña_Usuario_Update" wire:model.defer='ActPassword'>
                        @error('ActPassword')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="Closemodal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="save" wire:click="save">Actualizar usuario</button>
                <span wire:loading wire:target="save">Cargando Mi estimado :)</span>
                </div>
            </div>
            </div>
        </div>
    @else
        <h1>El usuario no se encontro :(</h1>
    @endif
    
</div>