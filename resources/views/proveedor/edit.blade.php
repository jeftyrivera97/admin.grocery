@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Actualizar</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"> <a href="{!! url('proveedor') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="{!!route('proveedor.update', $proveedores->id_proveedor)!!}" method="POST">
    @method('PATCH')
    @csrf
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                  <h3 class="card-title">Proveedor: {{$proveedores->descripcion}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="codigo_proveedor">RTN</label>
                            <input type="text" class="form-control" name="codigo_proveedor" value="{{$proveedores->codigo_proveedor}}" placeholder="Ingrese RTN">
                         </div>
            
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" name="descripcion" value="{{$proveedores->descripcion}}" placeholder="Ingrese Descripcion">
                        </div>
            
                        <div class="form-group">
                              <label for="categoria">Categoria</label>
                              <input type="text" class="form-control" name="categoria" value="{{$proveedores->categoria}}" placeholder="Ingrese Categoria">
                          </div>
            
                        <div class="form-group">
                            <label for="contacto">Nombre Contacto</label>
                            <input type="text" class="form-control" name="contacto" value="{{$proveedores->contacto}}" placeholder="Ingrese Contacto">
                        </div>
            
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" value="{{$proveedores->telefono}}" placeholder="Ingrese Telefono">
                        </div>             
                        </div>                
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Guardar</button>     
                    </div>
                </div>
                <!-- /.card -->
          </div>
  
      </div>
  </div>
  </form>
@endsection



