@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores</h1>
    <p>Administracion de proveedores</p>
    @if(session('error'))
<div class="alert {{session('tipo')}} alert-dismissible fade show" role="alert">
    <strong>{{session('error')}}</strong> {{session('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <table id="example"  class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre de fantasia</td>
                    <td>RUT</td>
                    <td>Telefono</td>
                    <td>comuna</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $u)
                <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->nombre_fantasia}}</td>
                        <td>{{$u->rut}}</td>
                        <td>{{$u->telefono}}</td>
                        <td>{{$u->comuna['comuna']}}</td>
                        
                        <td><div class="btn-group">
                            <a type="button" class="btn btn-success" href="{{route('proveedores.editar', $u->id)}}">Datos</a>
                            
                          </div></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{{route('proveedores.create')}}}">Crear proveedor</a>
            
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

