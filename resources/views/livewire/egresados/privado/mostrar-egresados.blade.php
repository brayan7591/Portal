<div>
    <p>Busqueda por programa de formacion: </p>
    <select class="form-control me-2" wire:model="for">
        <option value="todos">Todos</option>
        @foreach ($programas as $programa)
            <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
        @endforeach
    </select>
    <label class="w-100">
        <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model="search">
    </label>

    @if ($egresados->count())
        <div class="table-responsive mt-2">
            <table class="table table-hover table-dark text-center">
                <thead>
                    <tr>
                        <th scope="col" class="cursor-pointer align-middle" style="min-width: 100px">
                            Id
                        </th>
                        <th scope="col" class="cursor-pointer align-middle" style="min-width: 200px">
                            Nombre
                        </th>
                        <th scope="col" class="cursor-pointer align-middle">
                            Programa
                        </th>
                        @can('Users.edit',)
                            <th scope="col">Opciones</th>                            
                        @elsecan('Users.destroy')
                            <th scope="col">Opciones</th>
                        @endcan
                    </tr>
            </thead>
            <tbody>
                @foreach ($egresados as $egresado)
                <tr>
                        <th scope="row" class="align-middle">{{$egresado->id}}</th>
                        <td class="align-middle">{{$egresado->nombre}}</td>
                        <td class="align-middle">{{$egresado->programa->NombrePrograma}}</td>
                        <td class="options">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModificarUsuario">Actualizar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>                            
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        @if ($egresados->hasPages())
            <div>
                {{$egresados->links()}}
            </div>
        @endif
    @else
        <h1>No hay Egresados Destacados por el momento :(</h1>
    @endif
</div>
