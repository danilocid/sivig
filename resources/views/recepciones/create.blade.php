@extends('adminlte::page')

@section('title', 'Agregar recepcion')

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
            <h3 class="card-title">Agregar recepcion</h3>
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
                    <form role="form" action="{{ route('recepciones.addarticulo') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-12 form-group">
                                <label>Articulo</label>
                                <select id="articulo" autofocus name="articulo" required class="form-control select2">
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
                                            '</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Neto unitario</label>
                                <input name="costo_neto" id="costo_neto" min="1" class="form-control" required
                                    type="number" oninput="ActualizaValorCostoTotal()">
                            </div>
                            <div class="form-group col-6">
                                <label>I.V.A.</label>
                                <input name="costo_imp" id="costo_imp" readonly required type="number"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-goup row">
                            <div class="form-group col-6">
                                <label>Total unitario</label>
                                <input name="costo_total" id="costo_total" min="1" required type="number"
                                    oninput="ActualizaValorCostoNeto()" class="form-control">
                            </div>
                            <div class="col-6">
                                <label>Unidades</label>
                                <input name="unidades" required min="1" type="number" class="form-control">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary pull-left">Agregar articulo</button>
                        <div class="btn-group">


                            <a type="button" class="btn btn-success" href="{{ route('articulos.create') }}">Crear
                                articulo</a>
                        </div>

                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-warning pull-right" data-toggle="modal"
                                data-target="#modal-default">
                                Finalizar recepcion
                            </button>
                        </div>
                    </form>


                </div>
                @if (session('recepcion'))
                    <div class="col-md-6">
                        @php
                            $total_unidades = 0;
                            $total_costo_neto = 0;
                            $total_costo_imp = 0;
                            $total_costo_total = 0;
                            
                            foreach (session('recepcion') as $r) {
                                $total_unidades += $r->cantidad;
                                $total_costo_neto += $r->precio_unitario * $r->cantidad;
                                $total_costo_imp += $r->impuesto_unitario * $r->cantidad;
                                $total_costo_total += ($r->precio_unitario + $r->impuesto_unitario) * $r->cantidad;
                            }
                        @endphp


                        <ol>
                            <li><Strong>Total unidades: </Strong>{{ number_format($total_unidades, 0, ',', '.') }}</li>
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
            Crear articulo
        </div>
        <!-- /.card-footer-->
    </div>
    @if (session('recepcion'))
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detalle recepcion </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
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
                        @foreach (session('recepcion') as $r)
                            <tr>
                                <th>{{ $r->articulo->id }}</th>
                                <td>{{ $r->articulo->descripcion }}</td>
                                <td>{{ number_format($r->cantidad, 0, ',', '.') }}</td>
                                <td>${{ number_format($r->precio_unitario, 0, ',', '.') }}</td>
                                <td>${{ number_format($r->impuesto_unitario, 0, ',', '.') }}</td>
                                <td>${{ number_format(($r->precio_unitario + $r->impuesto_unitario) * $r->cantidad, 0, ',', '.') }}
                                </td>
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
        function ActualizaValorCostoTotal() {
            let valor = document.getElementById("costo_neto").value;
            document.getElementById("costo_total").value = Math.round(valor * 1.19);
            document.getElementById("costo_imp").value = Math.round((valor * 1.19) - valor);

        }

        function ActualizaValorCostoNeto() {
            let valor = document.getElementById("costo_total").value;
            document.getElementById("costo_neto").value = Math.round(valor / 1.19);
            document.getElementById("costo_imp").value = Math.round(valor - (valor / 1.19));

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
