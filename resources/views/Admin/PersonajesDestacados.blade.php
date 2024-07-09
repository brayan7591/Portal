@extends('adminlte::page')

@section('title', 'Egresados y Aprendices')

@section('content_header')
    <h1 class="text-center">EGRESADOS Y APRENDICES</h1>
@stop

@section('content')
    <livewire:admin.personajes-destacados lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/tablas.css')}} ">
@stop

@section('js')
    <script>
        Livewire.on('PersonajeDestacadoAgregado', function (){
            document.getElementById('CloseAgregarPersonajeDestacado').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has agregado un nuevo personaje destacado",
                type: "success"
            })
        })
        Livewire.on('PersonajeDestacadoActualizado', function (){
            document.getElementById('CloseActualizarPersonajeDestacado').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has actualizado el personaje destacado",
                type: "success"
            })
        })

        Livewire.on('deletePersonajes', personajeId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este personaje destacado?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.personajes-destacados', 'deletePersonaje', [personajeId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este personaje destacado ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })
    </script>
@stop