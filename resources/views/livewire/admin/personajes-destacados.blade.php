<div>
    <p>Buscar por: </p>
    <select class="form-control me-2" wire:model.live="personaje">
        <option value="todos">Todos</option>
        <option value="aprendiz">Aprendices</option>
        <option value="egresado">Egresados</option>
    </select>
    <label class="w-100">
        <input class="form-control me-2" type="search" placeholder="Escribe Aqui" aria-label="Search" wire:model.live="search">
    </label>
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
                            <th scope="col">Opciones</th>                            
                        @elsecan('Destacados.destruir')
                            <th scope="col">Opciones</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($destacados as $destacado)
                        <tr>
                            <th scope="row" class="align-middle">{{$destacado->id}}</th>
                            <td class="align-middle">{{$destacado->nombre}}</td>
                            <td class="align-middle">{{$destacado->correo}}</td>
                            <td class="align-middle">{{$destacado->numero_ficha}}</td>
                            <td class="align-middle">{{$destacado->programa->NombrePrograma}}</td>
                            <td class="align-middle">{{$destacado->rol}}</td>
                            <td class="align-middle">{{$destacado->motivo}}</td>
                            @can('Destacados.editar')
                                <td class="align-middle">
                                    <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#ModificarUsuario" wire:click="update({{$destacado->id}})">Actualizar</button>
                                    @can('Destacados.destruir')
                                        <button class="btn btn-danger" wire:click="$dispatch('deleteUser', {{$destacado->id}})">Eliminar</button>
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
            <h3>Actualmente no hay Personajes destacados</h3>
        </div>
    @endif
    @if ($destacados->hasPages())
        <div>
            {{$destacados->links()}}
        </div>
    @endif
</div>
