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
                        <td><button class="btn btn-primary">Actualizar</button></td>
                        <td><button class="btn btn-danger">Eliminar</button></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    @else
        <h1>El usuario no se encontro :(</h1>
    @endif
    
</div>
