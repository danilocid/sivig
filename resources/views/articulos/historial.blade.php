@extends('adminlte::page')

@section('title', 'Articulos')

@section('content_header')
    <h1>Articulos</h1>
    <p>Administracion de articulos</p>
    @if (session('error'))
        <div class="alert {{ session('tipo') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong> {{ session('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Resumen articulo</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    {{-- <p>{{ $articulo }}</p> --}}
                    <p><strong>ID articulo:</strong> {{ $articulo->id }}</p>
                    <p><strong>Codigo interno:</strong> {{ $articulo->cod_interno }}</p>
                    <p><strong>Codigo de barras:</strong> {{ $articulo->cod_barras }}</p>
                    <p><strong>Descripcion:</strong> {{ $articulo->descripcion }}</p>
                    <p><strong>Stock:</strong> {{ $articulo->stock }}</p>
                    <p><strong>Stock critico:</strong> {{ $articulo->stock_critico }}</p>

                </div>
                <div class="col-4">
                    <p><strong>Costo neto:</strong>$ {{ number_format($articulo->costo_neto, 0, '', '.') }}</p>
                    <p><strong>I.V.A.:</strong>$ {{ number_format($articulo->costo_imp, 0, '', '.') }}</p>
                    <p><strong>Costo total:</strong>$
                        {{ number_format($articulo->costo_neto + $articulo->costo_imp, 0, '', '.') }}</p>
                    <p><strong>Costo total stock:</strong>$
                        {{ number_format(($articulo->costo_neto + $articulo->costo_imp) * $articulo->stock, 0, '', '.') }}
                    </p>
                </div>
                <div class="col-4">
                    <p><strong>Venta neto:</strong>$ {{ number_format($articulo->venta_neto, 0, '', '.') }}</p>
                    <p><strong>I.V.A.:</strong>$ {{ number_format($articulo->venta_imp, 0, '', '.') }}</p>
                    <p><strong>Venta total:</strong>$
                        {{ number_format($articulo->venta_neto + $articulo->venta_imp, 0, '', '.') }}</p>
                    <p><strong>Venta total stock:</strong>$
                        {{ number_format(($articulo->venta_neto + $articulo->venta_imp) * $articulo->stock, 0, '', '.') }}
                    </p>
                    <p><strong>Margen de venta:
                        </strong>{{ number_format((($articulo->venta_neto + $articulo->venta_imp - ($articulo->costo_neto + $articulo->costo_imp)) / ($articulo->costo_neto + $articulo->costo_imp)) * 100, 2, ',', '.') }}%
                    </p>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Movimiento</td>
                        <td>Ver</td>
                        <td>Codigo</td>
                        <td>Descripcion</td>
                        <td>Cantidad</td>
                        <td>Fecha</td>
                        <td>Usuario</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($historial as $h)
                        <tr>
                            <td>{{ $h->id }}</td>
                            <td>{{ $h->Movimiento->tipo_movimiento }}</td>
                            <td>
                                @switch($h->Movimiento->id)
                                    @case(1)
                                        <a type="button" class="btn btn-success"
                                            href="{{ route('recepciones.view', $h->id_movimiento) }}">Recepcion</a>
                                    @break

                                    @case(2)
                                        <a type="button" class="btn btn-success"
                                            href="{{ route('ventas.show', $h->id_movimiento) }}">Venta</a>
                                    @break

                                    @default
                                        <a type="button" class="btn btn-success" href="">Datos</a>
                                @endswitch
                            </td>
                            <td>{{ $h->Articulo->cod_interno }}</td>
                            <td>{{ $h->Articulo->descripcion }}</td>
                            <td>{{ $h->cantidad }}</td>
                            <td> @datetime($h->created_at) </td>
                            <td>{{ $h->User->name }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>

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
                        visible: true,
                        searchable: true,
                    }, ],
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',

                        {
                            extend: 'print',
                            text: 'Imprimir',
                            autoPrint: true,
                            exportOptions: {
                                columns: [0, 1, 3, 4, 5, 6, 7]
                            },

                            customize: function(win) {
                                $(win.document.body).css('font-size', '16pt');
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');

                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            filename: 'historial.pdf',

                            title: 'Historial {{ $articulo->cod_interno }}',
                            pageSize: 'LETTER',
                            exportOptions: {
                                columns: [0, 1, 3, 4, 5, 6, 7]
                            }


                        }





                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    @stop

    @section('footer')
        <div class="float-right d-none d-sm-block">
            <b>Version</b> @version('compact')
        </div>
    @stop
