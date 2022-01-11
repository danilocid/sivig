@extends('adminlte::page')

@section('title', 'Articulos')

@section('content_header')
    <h1>Articulos</h1>
    <p>Administracion de articulos</p>
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
                    <td>Codigo interno</td>
                    <td>Codigo de barras</td>
                    <td>Descripcion</td>
                    <td>Stock</td>
                    <td>PVP</td>
                    <td>Activo</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($articulos as $u)
                <tr>
                        <td>{{$u->id}}</td>
                        <td>{{$u->cod_interno}}</td>
                        <td>{{$u->cod_barras}}</td>
                        <td>{{$u->descripcion}}</td>
                        <td>{{$u->stock}}</td>
                        <td>$ {{ number_format($u->venta_neto + $u->venta_imp, 0,'', '.')}}</td>
                        @if ($u->activo)
                        <td>Activo</td>
                        @else
                        <td>Inactivo</td>
                        @endif
                        
                        
                        <td><div class="btn-group">
                            <a type="button" class="btn btn-success" href="{{route('articulos.editar', $u->id)}}">Datos</a>
                            
                          </div></td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="btn-group">
            <a type="button" class="btn btn-success" href="{{{route('articulos.create')}}}">Crear articulo</a>
            
            </div>
        </div>
</div>
        
    
@stop

@section('js')
    <script> $(document).ready(function() {
        $('#example').DataTable({
            "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": false,
                "searchable": true
            }],
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    }
        );
    } ); </script>
@stop

