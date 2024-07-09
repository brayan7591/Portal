@extends('adminlte::page')

@section('title', 'Proyectos')

@section('content_header')
    <h1 class="text-center">PROYECTOS</h1>
@stop

@section('content')
    <livewire:admin.proyectos lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/proyectos.css')}}">
@stop

@section('js')
    <script>
        Livewire.on('ProyectoAgregado', function (){
            document.getElementById('CloseAgregarProyecto').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha agregado un nuevo proyecto",
                type: "success"
            })
        })

        Livewire.on('ProyectoActualizado', function (){
            document.getElementById('CloseActualizarProyecto').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Se ha actualizado el proyecto",
                type: "success"
            })
        })

        Livewire.on('deleteproyecto', proyectoId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este proyecto?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.proyectos', 'deleteproyectos', [proyectoId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este proyecto ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })
    </script>
@stop