<div>
    <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarRol">Agregar Rol</button>
  
  <!-- Modal -->
    <div class="modal fade" id="AgregarRol" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="post">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Crear nuevo Rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="Rol" class="form-label h4 font-weight-normal">Nombre del rol:</label>
                        <input type="text" class="form-control" name="rol" id="Rol" wire:model='rol'>
                        @error('rol')
                            <span>
                                {{$message}}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <p class="form-label h4 font-weight-normal">Permisos del rol:</p>
                        @foreach ($permisos as $permiso)
                            <div class="form-check">
                                <label class="form-check-label h5">
                                    <input class="form-check-input" type="checkbox" name="permisos[]" value="{{$permiso->id}}">{{$permiso->description}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="Closemodal" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Rol</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
