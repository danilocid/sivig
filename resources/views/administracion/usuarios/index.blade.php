@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
    <p>Administracion de usuarios</p>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Usuario</td>
                    <td>Mail</td>
                    <td>Activo</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $u)
                <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->user}}</td>
                        <td>{{$u->email}}</td>
                        <td>
                        @if ($u->active === 1)
                           Activo
                       
                        @else
                           Inactivo
                        @endif       
                        </td>
                        <td><div class="btn-group">
                            <a type="button" class="btn btn-success" href="{{route('configuracion.usuarios.editar', $u->id)}}">Datos</a>
                            
                          </div></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{route('configuracion.usuarios.create')}}">Crear usuario</a>
            
            </div>
        </div>
</div>
           
    
@stop

@section('js')
    <script> $(document).ready(function() {
        $('#example').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    }
        );
    } ); </script>
@stop

