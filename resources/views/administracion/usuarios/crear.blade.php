@extends('adminlte::page')

@section('title', 'Crear usuario')

@section('content_header')
   
@stop

@section('content')
  
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Crear usuario</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <div class="col-md-6">
                <form role="form" action="{{route('configuracion.usuarios.store')}}" method="POST">
                        @csrf
                        
                        <div class ="form-group">
                                <label>Nombre</label>
                                <input name="nombre" required type="text" class="form-control">
                        </div>
                        <div class ="form-group">
                                <label>Usuario</label>
                                <input name="user" required type="text" class="form-control">
                        </div>
                        <div class ="form-group">
                            <label>Contraseña</label>
                            <input name="password" required type="password" class="form-control">
                    </div>
                        <div class ="form-group">
                                <label>E-mail</label>
                                <input name="email" required type="mail" class="form-control" >
                        </div>
                        <div class ="form-group">
                                <label>Activo</label>
                                <select id="activo" name="activo" class="form-control">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                               
                                </select>
                        </div>
                <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#modal">Crear usuario</button>
  <div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Crear usuario</h4>
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
              
              
          <!-- Fin contenido -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        Crear cliente
        </div>
        <!-- /.card-footer-->
      </div>
    
@stop

@section('js')
   
@stop

