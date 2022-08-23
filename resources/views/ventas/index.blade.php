@extends('adminlte::page')
@section('title', 'Ver Ventas')
@section('content_header')
    <h1>Ventas</h1>
    <p>Administracion de ventas</p>
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
                            <td>Cliente</td>
                            <td>Documento</td>
                            <td>Monto</td>
                            <td>Medio de pago</td>
                            <td>Fecha</td>
                            <td>Usuario</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $v)
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ $v->Cliente->nombre }} ({{ $v->Cliente->rut }})</td>
                                <td>{{ $v->TipoDocumento->tipo_documento }}: {{ $v->documento }}</td>
                                <td>$ {{ number_format($v->monto_neto + $v->monto_imp, 0, '', '.') }}</td>
                                <td>{{ $v->MedioDePago->medio_de_pago }}</td>
                                <td>{{ date('d-m-Y H:s', strtotime($v->created_at)) }}</td>
                                <td>{{ $v->user->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="{{ route('ventas.show', $v->id) }}">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="{{ route('ventas.create') }}">Agregar venta</a>
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

                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    @stop
