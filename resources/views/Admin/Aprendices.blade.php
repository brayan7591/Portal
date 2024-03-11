@extends('adminlte::page')

@section('title', 'Aprendices Destacados')

@section('content_header')
    <h1>Aprendices Destacados</h1>
@stop

@section('content')
    @livewire('aprendices.privado.mostrar-aprendices')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/index.css')}} ">
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    <script>
        Livewire.on('alertLibros', function (){
            document.getElementById('CerrarLibro').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo libro",
                type: "success"
            })
        })
        Livewire.on('ActualizarLibro', function (){
            document.getElementById('CerrarLibroActualizar').click();
            document.getElementById('inputImage').value = null;
            Swal.fire({
                title: "Bien hecho!",
                text: "Has actualizado el libro",
                type: "success"
            })
        })
        Livewire.on('deleteBook', bookId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este libro?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value == true) {

                        Livewire.emitTo('biblioteca.privado.mostrar-libros', 'delete', bookId)

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este libro ha sido borrado.",
                            type: "success"
                        });
                    }
                });
        })
    </script>
@stop
