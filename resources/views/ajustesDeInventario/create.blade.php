@extends('adminlte::page')

@section('title', 'Agregar ajuste de inventario')

@section('content_header')
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
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agregar ajuste de inventario</h3>
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
                <div class="col-md-6">
                    <form role="form" action="{{ route('ajustesdeinventario.addarticulo') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-12 form-group">
                                <label>Articulo</label>
                                <select id="articulo" autofocus name="articulo" onchange="updateCost()" required
                                    class="form-control select2">
                                    <option value="">Buscar articulo</option>
                                    <?php
                                    
                                    foreach ($articulos as $t) {
                                        echo '<option value="' .
                                            $t['id'] .
                                            '">' .
                                            $t['cod_barras'] .
                                            ' - ' .
                                            $t['cod_interno'] .
                                            ' - ' .
                                            $t['descripcion'] .
                                            '</option>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Neto unitario</label>
                                <input name="costo_neto" id="costo_neto" min="1" class="form-control" required
                                    type="number" readonly>
                            </div>
                            <div class="form-group col-4">
                                <label>I.V.A.</label>
                                <input name="costo_imp" id="costo_imp" readonly required type="number"
                                    class="form-control">
                            </div>
                            <div class="form-group col-4">
                                <label>Total unitario</label>
                                <input name="costo_total" readonly id="costo_total" min="1" required type="number"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-goup row">
                            <div class="form-group col-6">
                                <label>Salidas</label>
                                <input onchange="updateEntradas()" name="salidas" id="salidas" min="0" required
                                    type="number" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Entradas</label>
                                <input onchange="updateSalidas()" name="entradas" id="entradas" required min="0"
                                    type="number" class="form-control">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary pull-left">Agregar articulo</button>
                        <div class="btn-group">
                    </form>


                </div>
                @if (session('ajuste'))
                    @php
                        $total_salidas = 0;
                        $total_entradas = 0;
                        $total_costo_neto = 0;
                        $total_costo_imp = 0;
                        $total_costo_total = 0;
                        
                        foreach (session('ajuste') as $r) {
                            $total_salidas += $r->salidas;
                            $total_entradas += $r->entradas;
                            if ($r->salidas > 0) {
                                $total_costo_neto -= $r->costo_neto * $r->salidas;
                                $total_costo_imp -= $r->costo_imp * $r->salidas;
                            } else {
                                $total_costo_neto += $r->costo_neto * $r->entradas;
                                $total_costo_imp += $r->costo_imp * $r->entradas;
                            }
                            $total_costo_total += $total_costo_neto + $total_costo_imp;
                        }
                    @endphp
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-warning pull-right" data-toggle="modal"
                            data-target="#modal-default">
                            Finalizar ajuste
                        </button>
                    </div>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Finalizar ajuste</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{ route('ajustesdeinventario.store') }}" method="POST">
                                        @csrf



                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <input name="observaciones" type="text" required class="form-control"
                                                placeholder="Observaciones ...">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo movmiento</label>
                                            <select name="tipo_movimiento" class="form-control">
                                                @foreach ($tipo_movimientos as $r)
                                                    <option @if ($r->id == 4) selected @endif
                                                        value="{{ $r->id }}">{{ $r->tipo_movimiento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Monto total</label>
                                            <input id="monto_total" name="monto_total" disabled type="text"
                                                class="form-control input-sm"
                                                value="${{ number_format($total_costo_total, 0, ',', '.') }}">
                                            <input id="monto_neto" name="monto_neto" type="hidden"
                                                class="form-control input-sm" value="{{ $total_costo_neto }}">
                                            <input id="monto_imp" name="monto_imp" type="hidden"
                                                class="form-control input-sm" value=" {{ $total_costo_imp }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Total salidas</label>
                                            <input id="total_salidas" name="total_salidas" readonly type="text"
                                                class="form-control input-sm"
                                                value="{{ number_format($total_salidas, 0, ',', '.') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Total entradas</label>
                                            <input id="total_entradas" name="total_entradas" readonly type="text"
                                                class="form-control input-sm"
                                                value="{{ number_format($total_entradas, 0, ',', '.') }}">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Agregar ajuste</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



            </div>
            @if (session('ajuste'))
                <div class="col-md-6">



                    <ol>
                        <li><Strong>Total salidas: </Strong>{{ number_format($total_salidas, 0, ',', '.') }}</li>
                        <li><Strong>Total entradas: </Strong>{{ number_format($total_entradas, 0, ',', '.') }}</li>
                        <li><Strong>Total costo neto: </Strong>${{ number_format($total_costo_neto, 0, ',', '.') }}</li>
                        <li><Strong>Total costo impuesto: </Strong>${{ number_format($total_costo_imp, 0, ',', '.') }}
                        </li>
                        <li><Strong>Total costo total: </Strong>${{ number_format($total_costo_total, 0, ',', '.') }}
                        </li>
                    </ol>

                    <br>

                </div>
            @endif
        </div>
    </div>

    <br>

    <!-- Fin contenido -->


    <!-- /.card-body -->
    <div class="card-footer">
        Agregar ajuste de inventario
    </div>
    <!-- /.card-footer-->
    </div>
    @if (session('ajuste'))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detalle recepcion </h3>

            </div>
            <div class="card-body">

                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Codigo</td>
                            <td>Descripcion</td>
                            <td>Salidas</td>
                            <td>Entradas</td>
                            <td>Stock final</td>
                            <td>Unitario</td>

                            <td>I.V.A.</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('ajuste') as $r)
                            <tr>
                                <th>{{ $r->articulo->cod_interno }}</th>
                                <td>{{ $r->articulo->descripcion }}
                                <td>{{ number_format($r->salidas, 0, ',', '.') }}</td>
                                <td>{{ number_format($r->entradas, 0, ',', '.') }}</td>
                                @if ($r->salidas > 0)
                                    <td>{{ number_format($r->articulo->stock - $r->salidas, 0, ',', '.') }}</td>
                                @else
                                    <td>{{ number_format($r->articulo->stock + $r->entradas, 0, ',', '.') }}</td>
                                @endif
                                <td>${{ number_format($r->costo_neto, 0, ',', '.') }}</td>
                                <td>${{ number_format($r->costo_imp, 0, ',', '.') }}</td>
                                @if ($r->entradas > 0)
                                    <td>${{ number_format(($r->costo_neto + $r->costo_imp) * $r->entradas, 0, ',', '.') }}
                                    </td>
                                @endif
                                @if ($r->salidas > 0)
                                    <td>$ -{{ number_format(($r->costo_neto + $r->costo_imp) * $r->salidas, 0, ',', '.') }}
                                    </td>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br />
            </div>
    @endif
@stop

@section('js')

    <script>
        function updateCost() {
            let articulosAdd = [];

            @foreach ($articulos as $a)

                articulosAdd.push({
                    id: {{ $a->id }},
                    stock: {{ $a->stock }},
                    costo_total: {{ $a->costo_neto + $a->costo_imp }},
                    costo_imp: {{ $a->costo_imp }},
                    costo_neto: {{ $a->costo_neto }},

                });
            @endforeach
            console.table(articulosAdd);
            let id = document.getElementById("articulo").value;

            document.getElementById("salidas").setAttribute("max", articulosAdd.find(a => a.id == id).stock);
            document.getElementById("costo_total").value = Math.round(articulosAdd.find(a => a.id == id).costo_total);
            document.getElementById("costo_imp").value = Math.round(articulosAdd.find(a => a.id == id).costo_imp);
            document.getElementById("costo_neto").value = Math.round(articulosAdd.find(a => a.id == id).costo_neto);

        }

        function updateSalidas() {
            document.getElementById("salidas").value = 0;
        }

        function updateEntradas() {
            document.getElementById("entradas").value = 0;
        }

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
