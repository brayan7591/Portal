@extends('adminlte::page')

@section('title', 'Eventos y galeria')

@section('content_header')
    <h1 class="text-center">EVENTOS Y GALERIA DE IMAGENES</h1>
@stop

@section('content')
    <livewire:admin.eventos lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/eventos.css')}}">
@stop

@section('js')
    <script>
        Livewire.on('deleteImagen', imagenId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar esta imagen de la galeria?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.eventos', 'deleteImagenes', [imagenId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Esta imagen de la galeria ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })

        Livewire.on('deleteEvento', EventoId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este evento?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.eventos', 'deleteEventos', [EventoId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este evento ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })

        Livewire.on('ImagenAgregada', function (){
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha agregado una nueva imagen a la galeria",
                type: "success"
            })
        })

        Livewire.on('EventoAgregado', function (){
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha agregado un nuevo evento",
                type: "success"
            })
        })

        Livewire.on('ImagenActualizada', function (){
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha actualizado la imagen de la galeria",
                type: "success"
            })
        })

        Livewire.on('EventoActualizado', function (){
            document.getElementById('CloseActualizarEvento').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha actualizado el evento",
                type: "success"
            })
        })
    </script>
@stop