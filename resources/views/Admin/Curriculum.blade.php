@extends('adminlte::page')

@section('title', 'Curriculum')

@section('content_header')
    <h1 class="text-center">CURRICULUM</h1>
@stop

@section('content')
    @livewire('admin.curriculum')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/curriculum.css') }}">
    <style>
        :root{
            scrollbar-gutter: stable;
        }
    </style>
@stop

@section('js')
    <script>
    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight) + "px";
    }
    </script>
    
    <script>
        Livewire.on('deleteCompetencia', CompetenciaCodigo => {
            Swal.fire({
                title: "¿Estas seguro de eliminar esta competencia?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value == true) {

                        Livewire.dispatchTo('curriculum.privado.informacion-curriculum', 'delete', [CompetenciaCodigo])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Esta competencia ha sido eliminada.",
                            type: "success"
                        });
                    }
                });
        });

        Livewire.on('deleteProgramaNivel', ProgramaNivel => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este curriculum?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.curriculum', 'deleteNivel', [ProgramaNivel])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este curriculum ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })
        Livewire.on('ActualizadoPrograma', function(){
            document.getElementById('ClosemodalUpdate').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has Actualizado el programa",
                type: "success"
            })
        })

        Livewire.on('CompetenciaActualizada', function(){
            document.getElementById('ClosemodalActualizarCompetencia').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has Actualizado la competencia",
                type: "success"
            })
        })

        Livewire.on('CompetenciaAgregada', function(){
            document.getElementById('ClosemodalAgregarCompetencia').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has agregado la competencia",
                type: "success"
            })
        })

        Livewire.on('ProgramaAgregado', function(){
            document.getElementById('ClosemodalAgregar').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has Agregado el programa",
                type: "success"
            })
        })

        Livewire.on('ActualizadoDato', function(){
            document.getElementById('ClosemodalActualizarDato').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has actualizado el dato",
                type: "success"
            })
        })

        Livewire.on('NuevoDato', function(){
            document.getElementById('ClosemodalAgregarDato').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has guardado el dato",
                type: "success"
            })
        })

        Livewire.on('deleteDato', Dato => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este Dato?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value == true) {

                        Livewire.dispatchTo('curriculum.privado.informacion-curriculum', 'deleteDatos', [Dato])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este Dato ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })

        Livewire.on('deleteTodosDato', Dato => {
            Swal.fire({
                title: "¿Estas seguro de eliminar todos estos datos?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.value == true) {

                        Livewire.dispatchTo('curriculum.privado.informacion-curriculum', 'deleteTodosDatos', [Dato])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Estos datos han sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })
    </script>
@stop