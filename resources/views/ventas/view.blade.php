@extends('adminlte::page')

@section('title', 'Ver recepcion')

@section('content_header')
    <h2>Ver recepcion</h2>
@stop


@section('content')
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Recepcion {{ $recepcion->id }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <ul>
                    <li><strong>Proveedor: </strong>{{ $recepcion->Proveedor->nombre_fantasia }}
                        ({{ $recepcion->Proveedor->rut }})</li>
                    <li><strong>Fecha recepcion:</strong> {{ date('d-m-Y', strtotime($recepcion->fecha_recepcion)) }}</li>
                    <li><strong> {{ $recepcion->documentos->tipo_documento }}:</strong> {{ $recepcion->documento }}</li>
                    <li><strong>Monto total:</strong>
                        ${{ number_format($recepcion->total_neto + $recepcion->total_iva, 0, ',', '.') }}</li>
                    <li><strong>Unidades:</strong> {{ number_format($recepcion->unidades, 0, ',', '.') }}</li>
                    <li><strong>Observaciones: </strong>{{ $recepcion->observaciones }}</li>
                    <li><strong>Usuario: </strong> {{ $recepcion->user->name }}</li>
                </ul>
            </div>

            <!-- Fin contenido -->
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            Recepcion
        </div>
        <!-- /.card-footer-->
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Detalle recepcion {{ $recepcion->id }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Codigo</td>
                        <td>Descripcion</td>
                        <td>Unidades</td>
                        <td>Unitario</td>
                        <td>I.V.A.</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalle as $d)
                        <tr>
                            <th>{{ $d->Producto->cod_interno }}</th>
                            <td>{{ $d->Producto->descripcion }}</td>
                            <td>{{ number_format($d->cantidad, 0, ',', '.') }}</td>
                            <td>${{ number_format($d->precio_unitario, 0, ',', '.') }}</td>
                            <td>${{ number_format($d->impuesto_unitario, 0, ',', '.') }}</td>
                            <td>${{ number_format(($d->precio_unitario + $d->impuesto_unitario) * $d->cantidad, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br />
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
                            filename: 'Recepcion.pdf',

                            title: 'Recepcion {{ $recepcion->id }}',
                            pageSize: 'LETTER',


                        }





                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    },
                });
            });
        </script>
    @stop
