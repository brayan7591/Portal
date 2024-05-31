@extends('adminlte::page')

@section('title', 'Voceros e Instructores')

@section('content_header')
    <h1 class="text-center">VOCEROS E INSTRUCTORES</h1>
@stop

@section('content')
    @livewire('admin.personajes-informativos')
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/instructores.css')}} ">
@stop

@section('js')
    <script>
        Livewire.on('deleteInstructor', InstructorId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este instructor?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.personajes-informativos', 'delete', [InstructorId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este instructor ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })

        Livewire.on('InstructorAgregado', function (){
            document.getElementById('CloseAgregarInstructor').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has agregado un nuevo instructor",
                type: "success"
            })
        })

        Livewire.on('InstructorActualizado', function (){
            document.getElementById('CloseActualizarInstructor').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has actualizado el instructor",
                type: "success"
            })
        })
    </script>
@stop