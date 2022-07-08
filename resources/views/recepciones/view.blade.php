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
      Recepcion</h3>

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

        
        <li>{{$detalle}}</li>
        @foreach($detalle as $d)
        <li>{{$d}}</li>
        <li>{{$d->Producto}}</li>
        @endforeach
        
     </ul>
     
    </div>

    <br>
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
      Detalle recepcion</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
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
                  <th>{{$d->Producto->cod_interno}}</th>
                  <td>{{$d->Producto->descripcion}}</td>
                  <td>{{ number_format(($d->cantidad), 0, ',', '.')}}</td>
                  <td>${{ number_format(($d->precio_unitario), 0, ',', '.')}}</td>
                  <td>${{ number_format(($d->impuesto_unitario), 0, ',', '.')}}</td>
                  <td>${{ number_format((($d->precio_unitario + $d->impuesto_unitario ) * $d->cantidad ), 0, ',', '.')}}</td>
              </tr>

              @endforeach
          </tbody>
      </table>
      <br />
      
  </div>
</div>

@stop

@section('js')

<script>
  $(document).ready(function () {
      $("#example").DataTable({
          order: [[0, "desc"]],
          columnDefs: [
              {
                  targets: [2],
                  visible: true,
                  searchable: true,
              },
          ],
          language: {
              url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
          },
      });
  });

</script>
@stop