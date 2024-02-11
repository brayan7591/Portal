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
                                        <button class="btn-danger h4">Eliminar</button>
                                        <button class="btn-primary h4">Actualizar</button>
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
                            <img src="{{asset('images/fondo3.jpg')}}" alt="imagen del libro">
                        </div>
                        <div class="detalles">
                            <div class="pagina">
                                <h2 class="text-center">N° X</h2>
                                <h1 class="text-center">No existe</h1>
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
</div>