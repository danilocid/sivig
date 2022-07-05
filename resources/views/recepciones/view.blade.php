@extends('adminlte::page')

@section('title', 'Ver recepcion')

@section('content_header')

@stop

@section('content')
<br>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Ver recepcion</h3>

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
       <li>Proveedor: {{$recepcion->Proveedor->nombre_fantasia}} ({{$recepcion->Proveedor->rut}})</li>
        <li>Fecha recepcion: {{date("d-m-Y", strtotime($recepcion->fecha_recepcion))}}</li>
        <li> {{$recepcion->documentos->tipo_documento}}: {{$recepcion->documento}}</li>
        <li>Monto total: ${{ number_format(($recepcion->total_neto + $recepcion->total_iva), 0, ',', '.')}}</li>
        <li>Unidades: {{ number_format(($recepcion->unidades), 0, ',', '.')}}</li>
        <li>Observaciones: {{$recepcion->observaciones}}</li>
        <li>Usuario: {{$recepcion->user->name}}</li>

        <li>{{$recepcion}}</li>
        <li>{{$detalle}}</li>
        @foreach($detalle as $d)
        <li>{{$d->Producto}}</li>
        @endforeach
        
     </ul>
     
    </div>

    <br>
    <!-- Fin contenido -->
  </div>

<!-- /.card-body -->
<div class="card-footer">
  Editar articulo
</div>
<!-- /.card-footer-->
</div>

@stop

@section('js')

<script>
  function ActualizaValorVentaTotal() {
    let valor = document.getElementById("venta_neto").value;
    document.getElementById("venta_total").value = Math.round(valor * 1.19);
    document.getElementById("venta_imp").value = Math.round((valor * 1.19) - valor);

    ActualizaValorGanancia();

  }
  function ActualizaValorCostoTotal() {
    let valor = document.getElementById("costo_neto").value;
    document.getElementById("costo_total").value = Math.round(valor * 1.19);
    document.getElementById("costo_imp").value = Math.round((valor * 1.19) - valor);

    ActualizaValorGanancia();

  }
  function ActualizaValorVentaNeto() {
    let valor = document.getElementById("venta_total").value;
    document.getElementById("venta_neto").value = Math.round(valor / 1.19);
    document.getElementById("venta_imp").value = Math.round(valor - (valor / 1.19));
    ActualizaValorGanancia();
  }
  function ActualizaValorCostoNeto() {
    let valor = document.getElementById("costo_total").value;
    document.getElementById("costo_neto").value = Math.round(valor / 1.19);
    document.getElementById("costo_imp").value = Math.round(valor - (valor / 1.19));
    ActualizaValorGanancia();
  }
  function ActualizaValorGanancia() {
    let venta_total = document.getElementById("venta_total").value;
    let costo_total = document.getElementById("costo_total").value
    document.getElementById("ganancia").value = venta_total - costo_total
    ActualizaValorGananciaPor();
  }
  function ActualizaValorGananciaPor() {
    let venta_total = document.getElementById("venta_total").value;
    let costo_total = document.getElementById("costo_total").value;
    document.getElementById("por_ganancia").value = Math.round(((venta_total - costo_total) / venta_total) * 100);
  }
</script>
@stop