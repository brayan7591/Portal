<div>
      <!-- Button trigger modal -->
      <button class="btn btn-success" id="modal" type="button" data-toggle="modal" data-target="#Agregarlibro">Agregar Libro</button>
  
      <!-- Modal -->
        <div class="modal fade" id="Agregarlibro" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="Agregar">
                    <div class="estanteria">
                        <div class="contenedor">
                            <div class="libro">
                                <div class="caratula">
                                    <img src="{{Storage::url('imagenes/logo.png')}}" alt="imagen del libro">
                                </div>
                                <div class="detalles">
                                    <div class="pagina">
                                        <h1 class="text-center">Agregar Libro</h1>
                                        <h2 class="text-center">A continuacion habra un formulario que tendras que llenar</h2>
                                        <h1 class="text-center">Dia de hoy: {{date("Y-m-d")}}</h1>
                                    </div>
                                    <div class="pagina">
                                        <h3>Rellena todos los campos para poder guardar el libro.</h3>
                                        <label>Id de la biblioteca:
                                            <input type="number" wire:model='IdBiblioteca'>
                                        </label>
                                        @error('IdBiblioteca')
                                            {{$message}}
                                        @enderror
                                        <label>Titulo:
                                            <input type="text" wire:model='Titulo'>
                                        </label>
                                        @error('Titulo')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de estreno:
                                            <input type="date" wire:model='FechaEstreno'>
                                        </label>
                                        @error('FechaEstreno')
                                            {{$message}}
                                        @enderror
                                        <label>Editorial:
                                            <input type="text" wire:model='Editorial'>
                                        </label>
                                        @error('Editorial')
                                            {{$message}}
                                        @enderror
                                        <label>Imagen:
                                            <input type="file" wire:model.live="Imagen">
                                        </label>
                                        @error('Imagen')
                                            {{$message}}
                                        @enderror
                                        <label>Formato:
                                            <input type="text" wire:model='Formato'>
                                        </label>
                                        @error('Formato')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de ingreso:
                                            <input type="date" wire:model='FechaIngreso'>
                                        </label>
                                        @error('FechaIngreso')
                                            {{$message}}
                                        @enderror
                                        <label>Programa de formacion:
                                            <input type="text" wire:model='ProgramaFormacion'>
                                        </label>
                                        @error('ProgramaFormacion')
                                            {{$message}}
                                        @enderror
                                        <label>Numero de copias:
                                            <input type="number" wire:model='Copias'>
                                        </label>
                                        @error('Copias')
                                            {{$message}}
                                        @enderror
                                        <label>Estado:
                                            <input type="text" wire:model='Estado'>
                                        </label>
                                        @error('Estado')
                                            {{$message}}
                                        @enderror
                                        <div class="opciones">
                                            <button type="button" data-dismiss="modal" id="CerrarLibro" aria-label="Close">Cerrar</button>
                                            <button wire:click="save">Guardar</button>
                                            <span wire:loading wire:target="save">Cargando Mi estimado :)</span>
                                        </div>
                                    </div>
                                    <div class="pagina">
                                        <h1 wire:target="image" wire:loading>Loading Image</h1>
                                        @if ($Imagen)
                                            <img src="{{$Imagen->temporaryUrl()}}" alt="">
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
