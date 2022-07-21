@extends('adminlte::page')
@section('title', 'Recepciones')
@section('content_header')
    <h1>Recepciones</h1>
    <p>Administracion de recepciones</p>
    @if (session('error'))
        <div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong> {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif @stop

    @section('content')

        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Proveedor</td>
                            <td>Documento</td>
                            <td>Observaciones</td>
                            <td>Unidades</td>
                            <td>Monto</td>
                            <td>Usuario</td>
                            <td>Fecha</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recepciones as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>
                                    {{ $u->Proveedor->nombre_fantasia }} ({{ $u->Proveedor->rut }})
                                </td>
                                <td>
                                    {{ $u->documentos->tipo_documento }}: {{ $u->documento }}
                                </td>
                                <td>{{ $u->observaciones }}</td>
                                <td>{{ $u->unidades }}</td>
                                <td>
                                    $
                                    {{ number_format($u->total_neto + $u->total_iva, 0, '', '.') }}
                                </td>
                                <td>{{ $u->user->name }}</td>
                                <td>{{ $u->fecha_recepcion }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="{{ route('recepciones.view', $u->id) }}">Datos</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="{{ route('recepciones.create') }}">Agregar recepcion</a>
                </div>
            </div>
        </div>

    @stop

    @section('js')
        <script>
            $(document).ready(function() {
                $("#example").DataTable({
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                        targets: [2],
                        visible: false,
                        searchable: true,
                    }, ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    @stop
