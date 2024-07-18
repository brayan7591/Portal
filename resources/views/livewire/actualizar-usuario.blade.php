<div class="container">
    <h1 class="text-center mt-2 text-white">Configuracion de la cuenta</h1>

    <h2 class="mt-3 text-white" >Configuracion inicial:</h2>
    <div class="bg-white p-3 mt-2 border border-4 border-black">
        <label for="act_nombre" class="h4">Actualiza tu nombre: </label><br>
        <input type="text" id="act_nombre" class="w-100 form-control" placeholder="Actualizar Nombre del usuario" wire:model="nombre">
        @error('nombre')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror

        <label for="act_correo" class="mt-3 h4">Actualiza tu correo electronico: </label><br>
        <input type="email" id="act_correo" class="w-100 form-control" placeholder="Actualizar Nombre del usuario" wire:model="correo">
        @error('correo')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror

        <div class="mt-2 py-2 d-flex align-items-center justify-content-end">
            <button class="btn btn-primary" wire:loading.class="disabled" wire:target="actualizarusuario" wire:click="actualizarusuario">Actualizar perfil</button>
        </div>
    </div>

    <h2 class="mt-3 text-white">Configuracion Contraseña</h2>
    <div class="bg-white p-3 mt-2 border border-4 border-black">
        <label for="contra_nueva" class="h4">Escribe tu nueva contraseña: </label><br>
        <input type="password" id="contra_nueva" class="w-100 form-control" placeholder="Escribe la nueva contraseña" wire:model="nuevaContra">
        @error('nuevaContra')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror

        <label for="contra_nueva_validacion" class="mt-3 h4">Valida tu nueva contraseña: </label><br>
        <input type="password" id="contra_nueva_validacion" class="w-100 form-control" placeholder="Confirma la nueva contraseña" wire:model="nuevaContraValidar">
        @error('nuevaContraValidar')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror

        <label for="contra_antigua" class="mt-3 h4">Valida tu anterior contraseña: </label><br>
        <input type="password" id="contra_antigua" class="w-100 form-control" placeholder="Escribe la contraseña actual" wire:model="antiguaContra">
        @error('antiguaContra')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror

        <div class="mt-2 py-2 d-flex align-items-center justify-content-end">
            <button class="btn btn-primary" wire:loading.class="disabled" wire:target="actualizarcontra" wire:click="actualizarcontra">Actualizar contraseña</button>
        </div>
    </div>

    <h2 class="mt-3 text-white">Eliminar cuenta:</h2>
    <div class="bg-white p-3 mt-2 border border-4 border-black">
        <label for="contra_borrar" class="mt-3 h4">Escribe tu contraseña actual para eliminar el usuario</label><br>
        <input type="password" id="contra_borrar" class="w-100 form-control" placeholder="Escribe la contraseña actual" wire:model="contraEliminar">
        @error('contraEliminar')
            <p class="w-100 bg-danger text-white p-2 mt-2">{{$message}}</p>
        @enderror
        <div class="mt-2 py-2 d-flex align-items-center justify-content-end">
            <button class="btn btn-danger" wire:loading.class="disabled" wire:target="delete" wire:click="delete"> Eliminar cuenta</button>
        </div>
    </div>
</div>
