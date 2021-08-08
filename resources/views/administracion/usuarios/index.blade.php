@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
    <p>Administracion de usuarios</p>
@stop

@section('content')
    
    
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
                            <button type="button" class="btn btn-success">Permisos</button>
                           
                          </div></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
    
    
@stop

@section('js')
    <script> $(document).ready(function() {
        $('#example').DataTable();
    } ); </script>
@stop

