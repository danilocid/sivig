@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Configuracion</h1>
    <p>Administracion de medios de pago</p>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($medio as $m)
                <tr>
                        <td>{{$m->id}}</td>
                        <td>{{$m->medio_de_pago}}</td>
                      
                        <td><div class="btn-group">
                            <a type="button" class="btn btn-success" href="{{route('configuracion.mediosdepago.editar', $m->id)}}">Datos</a>
                            
                          </div></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{route('configuracion.mediosdepago.create')}}">Crear usuario</a>
            
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

