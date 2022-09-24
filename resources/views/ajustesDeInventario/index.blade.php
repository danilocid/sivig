@extends('adminlte::page')
@section('title', 'Ajustes de Inventario')
@section('content_header')
    <h1>Ajustes de inventario</h1>
    <p>Administracion de articulos</p>
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
                            <td>Salidas</td>
                            <td>Entradas</td>
                            <td>Tipo de movimiento</td>
                            <td>Observaciones</td>
                            <td>Monto</td>
                            <td>Usuario</td>
                            <td>Fecha</td>
                            <td>Ver</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ajustesDeInventario as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->salidas }}</td>
                                <td>{{ $u->entradas }}</td>
                                <td>{{ $u->observaciones }}</td>
                                <td>{{ $u->movimiento->tipo_movimiento }}</td>
                                <td>
                                    $
                                    {{ number_format($u->costo_neto + $u->costo_imp, 0, '', '.') }}
                                </td>
                                <td>{{ $u->user->name }}</td>
                                <td>@datetime($u->created_at) </td>
                                <td>
                                    <div class="btn-group">
                                        <a type="button" class="btn btn-success"
                                            href="{{ route('ajustesdeinventario.view', $u->id) }}">Datos</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
                <div class="btn-group">
                    <a type="button" class="btn btn-success" href="{{ route('ajustesdeinventario.create') }}">Agregar
                        ajuste</a>
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
