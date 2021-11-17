@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Actualizar</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('empleado') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="{!!route('empleado.update', $empleados->id_empleado)!!}" method="POST">
    @method('PATCH')
    @csrf
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                  <h3 class="card-title">Empleado: {{$empleados->nombre}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="codigo_empleado">*Identidad</label>
                        <input type="text" class="form-control" name="codigo_empleado" value="{{$empleados->codigo_empleado}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre">*Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{$empleados->nombre}}" >
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre">*Puesto</label>
                            <input type="text" class="form-control" name="puesto" value="{{$empleados->puesto}}" >
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="text" class="form-control" name="telefono" value="{{$empleados->telefono}}">
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



