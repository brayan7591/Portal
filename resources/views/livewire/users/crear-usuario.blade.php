<div>
    <!-- Button trigger modal -->
    <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#AgregarUsuario">Agregar Usuario</button>
  
  <!-- Modal -->
    <div class="modal fade" id="AgregarUsuario" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Crear nuevo usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="Nombre_Usuario" class="form-label h4 font-weight-normal">Nombre del usuario:</label>
                    <input type="text" class="form-control" id="Nombre_Usuario" wire:model.defer='name'>
                    @error('name')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Email_Usuario" class="form-label h4 font-weight-normal">Correo del usuario:</label>
                    <input type="email" class="form-control" id="Email_Usuario" wire:model.defer='email'>
                    @error('email')
                    <span>
                        {{$message}}
                    </span>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="Contraseña_Usuario" class="form-label h4 font-weight-normal">Contraseña:</label>
                    <input type="password" class="form-control" id="Contraseña_Usuario" wire:model.defer='password'>
                    @error('password')
                        <span>
                            {{$message}}
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="Closemodal" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" wire:loading.class="disabled" wire:target="save" wire:click="save">Crear usuario</button>
            <span wire:loading wire:target="save">Cargando Mi estimado :)</span>
            </div>
        </div>
        </div>
    </div>
</div>
