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
                            <input name="costo_imp" id="costo_imp" readonly required type="number" class="form-control">
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

                </form>
            </div>
            @if (session('recepcion'))

                @foreach (session('recepcion') as $a => $r)
                    <br>
                    {{ $r }}
                    <br>
                @endforeach
            @endif

            <br>

            <!-- Fin contenido -->
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            Crear articulo
        </div>
        <!-- /.card-footer-->
    </div>

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
    </script>
@stop
