<div>
    <div class="buscador">
        <label>Busca aqui:
            <input type="text" wire:model="search">
        </label>
        <label>Cuantos deseas mirar:
            <select wire:model="Books">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="30">10</option>
            </select>
        </label>
    </div>
    @livewire('biblioteca.privado.agregar-libro')
    <section>
        @if ($libros->count())
            @foreach ($libros as $libro)
                <div class="estanteria">
                    <div class="contenedor">
                        <div class="libro">
                            <div class="caratula">
                                <img src="{{Storage::url($libro->Imagen)}}" alt="imagen del libro">
                            </div>
                            <div class="detalles">
                                <div class="pagina">
                                    <h2 class="text-center">N° {{$libro->IdBiblioteca}}</h2>
                                    <h1 class="text-center">{{$libro->Titulo}}</h1>
                                    <h1 class="text-center">{{$libro->Editorial}}</h1>
                                    <h1 class="text-center">{{$libro->FechaEstreno}}</h1>
                                </div>
                                <div class="pagina">
                                    <h1 class="text-center">{{$libro->Titulo}}</h1>
                                    <p class="h4">Esta disponible en {{$libro->Formato}} Con {{$libro->Copias}} Copias en nuestra Biblioteca y actualmente esta {{$libro->Estado}}.</p>
                                    <p class="h4">Estrenado el {{$libro->FechaIngreso}}</p>
                                    <div class="opciones">
                                        <button class="btn-danger h4" wire:click="$emit('deleteBook', {{$libro}})">Eliminar</button>
                                        <button class="btn-primary h4" type="button" data-toggle="modal" data-target="#Actualizarlibro" wire:click="update({{$libro}})">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($libros->hasPages())
                <div>
                    {{$libros->links()}}
                </div>
            @endif
        @else
            <div class="estanteria">
                <div class="contenedor">
                    <div class="libro">
                        <div class="caratula">
                            <img src="{{Storage::url('imagenes/fondo.jpg')}}" alt="imagen del libro">
                        </div>
                        <div class="detalles">
                            <div class="pagina">
                                <h2 class="text-center">N° X</h2>
                                <h1 class="text-center">No existe o no hay libros</h1>
                                <h1 class="text-center">No hay editorial</h1>
                                <h1 class="text-center">{{date("Y-m-d")}}</h1>
                            </div>
                            <div class="pagina">
                                <h1 class="text-center">No existe</h1>
                                <p class="h4">Lamentablemento no se encontro el libro F</p>
                                <p class="h4">buscado el {{date("Y-m-d")}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    @if ($libros->count())
        <div class="modal fade" id="Actualizarlibro" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="Agregar">
                    <div class="estanteria">
                        <div class="contenedor">
                            <div class="libro">
                                <div class="caratula">
                                    <img wire:loading.remove wire:target="update" src="{{Storage::url($ImagenActual)}}" alt="imagen del libro">
                                    <img wire:loading wire:target="update" src="{{Storage::url('imagenes/loading.gif')}}" alt="Cargando Portada">
                                </div>
                                <div class="detalles">
                                    <div class="pagina">
                                        <h1 class="text-center">Actualizar Libro</h1>
                                        <h2 wire:loading wire:target="update">Se estan cargando los datos :)</h2>
                                        <h2 class="text-center">A continuacion habra un formulario que tendras que llenar para poder actualizar el libro</h2>
                                        <h1 class="text-center">Dia de hoy: {{date("Y-m-d")}}</h1>
                                    </div>
                                    <div class="pagina">
                                        <h3>Rellena todos los campos para poder guardar el libro.</h3>
                                        <label>Id de la biblioteca:
                                            <input type="number" wire:model.defer='IdBibliotecaActualizar'>
                                        </label>
                                        @error('IdBibliotecaActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Titulo:
                                            <input type="text" wire:model.defer='TituloActualizar'>
                                        </label>
                                        @error('TituloActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de estreno:
                                            <input type="date" wire:model.defer='FechaEstrenoActualizar'>
                                        </label>
                                        @error('FechaEstrenoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Editorial:
                                            <input type="text" wire:model.defer='EditorialActualizar'>
                                        </label>
                                        @error('EditorialActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Imagen:
                                            <input type="file" wire:model="ImagenActualizar" id="inputImage" accept="image/*">
                                        </label>
                                        @error('ImagenActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Formato:
                                            <input type="text" wire:model.defer='FormatoActualizar'>
                                        </label>
                                        @error('FormatoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de ingreso:
                                            <input type="date" wire:model.defer='FechaIngresoActualizar'>
                                        </label>
                                        @error('FechaIngresoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Programa de formacion:
                                            <input type="text" wire:model.defer='ProgramaFormacionActualizar'>
                                        </label>
                                        @error('ProgramaFormacionActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Numero de copias:
                                            <input type="number" wire:model.defer='CopiasActualizar'>
                                        </label>
                                        @error('CopiasActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Estado:
                                            <input type="text" wire:model.defer='EstadoActualizar'>
                                        </label>
                                        @error('EstadoActualizar')
                                            {{$message}}
                                        @enderror
                                        <div class="opciones">
                                            <button type="button" data-dismiss="modal" id="CerrarLibroActualizar" aria-label="Close">Cerrar</button>
                                            <button wire:loading.remove wire:target="update" wire:click="Actualizar({{$ActualizarLibro}})">Actualizar</button>
                                        </div>
                                    </div>
                                    <div class="pagina">
                                        <h1 wire:target="image" wire:loading>Loading Image</h1>
                                        @if ($ImagenActualizar)
                                            <img src="{{$ImagenActualizar->temporaryUrl()}}">
                                        @else
                                            <img src="{{Storage::url($ImagenActual)}}">
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
</div>