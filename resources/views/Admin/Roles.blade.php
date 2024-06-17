@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1 class="text-center">ROLES EN EL SISTEMA</h1>
@stop

@section('content')
    <livewire:admin.roles lazy/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin/tablas.css')}} ">
@stop

@section('js')
    <script>
        Livewire.on('RolAgregado', function (){
            document.getElementById('ClosemodalAgregarRol').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has creado un nuevo rol",
                type: "success"
            })
        })

        Livewire.on('RolActualizado', function (){
            document.getElementById('ClosemodalActualizarRol').click();
            Swal.fire({
                title: "Bien hecho!",
                text: "Has actualizado el rol",
                type: "success"
            })
        })

        Livewire.on('deleteRole', role => {
        Swal.fire({
            title: "¿Estas seguro de eliminar este rol?",
            text: "Esta accion no se puede revertir! ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar!",
            cancelButtonText: "Cancelar"
            }).then((result) => {
                
                if (result.value == true) {

                    Livewire.dispatchTo('admin.roles', 'deleteRol', [role])

                    Swal.fire({
                        title: "Eliminado!",
                        text: "Este rol ha sido eliminado.",
                        type: "success"
                    });
                }
            });
        })
    </script>
@stop
