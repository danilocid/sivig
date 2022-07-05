@extends('adminlte::page')

@section('title', 'Editar usuario')

@section('content_header')
   
@stop

@section('content')
  
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar usuario</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <div class="col-md-6">
                <form role="form" action="{{route('configuracion.usuarios.update', $usuario)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class ="form-group">
                                <label>Nombre</label>
                                <input name="nombre" required type="text" class="form-control" value = "{{$usuario->name}}">
                        </div>
                        <div class ="form-group">
                                <label>Usuario</label>
                                <input name="user" required type="text" class="form-control" value = "{{$usuario->user}}">
                        </div>
                        <div class ="form-group">
                                <label>E-mail</label>
                                <input name="email" required type="text" class="form-control" value = "{{$usuario->email}}">
                        </div>
                        <div class ="form-group">
                                <label>Activo</label>
                                <select id="activo" name="activo" class="form-control">
                                @if ($usuario->active === 1)
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                                @else
                                <option value="1">Activo</option>
                                <option value="0" selected>Inactivo</option>
                                @endif    
                                </select>
                        </div>
                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Editar usuario</button>
  <div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Modificar usuario</h4>
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
        Editar usuario
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