@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nuevo Pago de Planilla</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('planilla') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="/planilla" method="POST">
    @csrf
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Nuevo Gasto</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          
                            <div class="form-group">
                              <label for="fecha">*Fecha Realizada</label>
                              <input class="form-control" name="fecha" required value="{{old('fecha')}}" type="date" data-date-format="aaaa/mm/dd" value="" id="fecha">
                            </div>
                          
                              <div class="form-group">
                                  <label for="id_empleado">*Empleado</label>
                                  <select name="id_empleado" input type="text" required class="form-control" name="id_producto">
                                    <option value="">--Seleccione el Empleado--</option>
                                    @foreach ($empleados as $empleado)
                                    <option value="{{ $empleado['id_empleado'] }}">{{$empleado['nombre'] }} - {{$empleado['codigo_empleado'] }}</option>
                                    @endforeach
                                  </select>
                                </div>
                  
                                <div class="form-group"> 
                                  <label for="total">*Pago a Empleado</label>
                                  <input class="form-control" type="number" required step="any" placeholder="0.00"name="total" id="total" value="">   
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
</form>


@endsection
