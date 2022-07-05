@extends('adminlte::page')

@section('title', 'Editar Medio de pago')

@section('content_header')

@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Editar medio de pago</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
        <i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
        <i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">
    <div class="col-md-6">
      <form role="form" action="{{route('configuracion.mediosdepago.update', $medio)}}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
          <label>Medio de pago</label>
          <input name="medio_de_pago" required type="text" class="form-control" value="{{$medio->medio_de_pago}}">
          <input name="id" required type="hidden" class="form-control" value="{{$medio->id}}">

        </div>


        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar medio de
          pago
        </button>
        <div class="modal fade" id="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h4 class="modal-title">Modificar medio de pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <p>Seguro que quiere guardar los cambios?&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </form>
    </div>

    <br>
    <!-- Fin contenido -->
  </div>
</div>
<!-- /.card-body -->
<div class="card-footer">
  Editar medio de pago
</div>
<!-- /.card-footer-->
</div>

@stop

@section('js')

@stop

@section('footer')
   <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')       
    </div>
@stop