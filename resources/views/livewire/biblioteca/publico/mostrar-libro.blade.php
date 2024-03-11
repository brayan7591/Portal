<div>
    <div class="buscador">
        <label>Busca aqui:
            <input type="text" wire:model="search">
        </label>
    </div>
    @if ($libros->count() < 2)
        <section class="one">
    @else
        <section>
    @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="estanteria">
                <div class="contenedor">
                    <div class="libro">
                        <div class="caratula">
                            <img src="{{Storage::url('imagenes/logo.png')}}" alt="imagen del libro">
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
