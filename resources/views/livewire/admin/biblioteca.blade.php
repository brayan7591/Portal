<div>
    <div class="buscador">
        <label>Busca aqui:
            <input type="text" wire:model.live="search">
        </label>
        <label>Cuantos deseas mirar:
            <select wire:model.live="Books">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="10">10</option>
            </select>
        </label>
    </div>
    @can('Biblioteca.crear')
        <button class="btn btn-success mb-2" id="modal" type="button" data-toggle="modal" data-target="#Agregarlibro">Agregar Libro</button>
    @endcan
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
                                    @can('Biblioteca.editar')
                                        <div class="opciones">
                                            @can('Biblioteca.destruir')
                                                <button class="btn-danger h4" wire:click="$dispatch('deleteBook', {{$libro}})">Eliminar</button>
                                            @endcan
                                            <button class="btn-primary h4" type="button" data-toggle="modal" data-target="#Actualizarlibro" wire:click="update({{$libro}})">Actualizar</button>
                                        </div>
                                    @elsecan('Biblioteca.destruir')
                                        <div class="opciones">
                                            <button class="btn-danger h4" wire:click="$dispatch('deleteBook', {{$libro}})">Eliminar</button>
                                        </div>
                                    @endcan
                                    
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
                            <img src="{{asset('favicons/favicon.ico')}}" alt="imagen de que no hay libro">
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
                                <p class="h4">Lamentablemento no se encontro el libro: {{$search}}</p>
                                <p class="h4">buscado el {{date("Y-m-d")}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <!-- Modal Actualizar Libro -->
    @can('Biblioteca.editar')
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
                                        <h3>Rellena todos los campos para poder actualizar el libro.</h3>
                                        <label>Id de la biblioteca:
                                            <input type="number" wire:model='IdBibliotecaActualizar'>
                                        </label>
                                        @error('IdBibliotecaActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Titulo:
                                            <input type="text" wire:model='TituloActualizar'>
                                        </label>
                                        @error('TituloActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de estreno:
                                            <input type="date" wire:model='FechaEstrenoActualizar'>
                                        </label>
                                        @error('FechaEstrenoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Editorial:
                                            <input type="text" wire:model='EditorialActualizar'>
                                        </label>
                                        @error('EditorialActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Imagen:
                                            <input type="file" wire:model.live="ImagenActualizar" id="inputImage" accept="image/*">
                                        </label>
                                        @error('ImagenActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Formato:
                                            <input type="text" wire:model='FormatoActualizar'>
                                        </label>
                                        @error('FormatoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Fecha de ingreso:
                                            <input type="date" wire:model='FechaIngresoActualizar'>
                                        </label>
                                        @error('FechaIngresoActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Programa de formacion:
                                            <select wire:model='ProgramaFormacionActualizar'>
                                                <option value="">Actualiza un programa de formación</option>
                                                @foreach ($programas as $programa)
                                                    <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        @error('ProgramaFormacionActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Numero de copias:
                                            <input type="number" wire:model='CopiasActualizar'>
                                        </label>
                                        @error('CopiasActualizar')
                                            {{$message}}
                                        @enderror
                                        <label>Estado:
                                            <input type="text" wire:model='EstadoActualizar'>
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
    @endcan


    <!-- Modal Agregar Libro-->
    @can('Biblioteca.crear')
        <div class="modal fade" id="Agregarlibro" wire:ignore.self tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="Agregar">
                    <div class="estanteria">
                        <div class="contenedor">
                            <div class="libro">
                                <div class="caratula">
                                    <img src="{{asset('favicons/favicon.ico')}}" alt="imagen del libro">
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
                                            <input type="file" wire:model.live="Imagen" accept="image/*">
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
                                            <select wire:model='ProgramaFormacion'>
                                                <option value="">Seleccione un programa de formación</option>
                                                @foreach ($programas as $programa)
                                                    <option value="{{$programa->id}}">{{$programa->NombrePrograma}}</option>
                                                @endforeach
                                            </select>
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
    @endcan
    
</div>
