@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1 class="text-center">USUARIOS EN EL SISTEMA</h1>
@stop

@section('content')
    <livewire:admin.usuarios lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/tablas.css')}} ">
@stop

@section('js')
    <script>

        Livewire.on('alert', function (){
            document.getElementById('Closemodal').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo usuario",
                type: "success"
            })
        })
        Livewire.on('Actualizado', function(){
            document.getElementById('ClosemodalUpdate').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has Actualizado el usuario",
                type: "success"
            })
        })
        Livewire.on('deleteUser', userId => {
            Swal.fire({
                title: "¿Estas seguro de eliminar este registro?",
                text: "Esta accion no se puede revertir! ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar!",
                cancelButtonText: "Cancelar"
                }).then((result) => {
                    
                    if (result.value == true) {

                        Livewire.dispatchTo('admin.usuarios', 'delete', [userId])

                        Swal.fire({
                            title: "Eliminado!",
                            text: "Este usuario ha sido eliminado.",
                            type: "success"
                        });
                    }
                });
        })
    </script>
@stop
