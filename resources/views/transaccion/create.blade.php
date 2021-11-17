@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Creditos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('cliente') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')


<form action="/transaccion" method="POST">
    @csrf
  
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Nueva Transaccion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="id_cliente">*Cliente</label>
                        <select name="id_cliente" required  id="id_cliente" class="form-control">
                          <option value="">--Selecione--</option>
                          @foreach ($clientes as $cliente)
                         <option value="{{ $cliente['id_cliente'] }}"> {{ $cliente['nombre'] }}  {{ $cliente['codigo_cliente'] }}</option>
                         @endforeach
                        </select>
                     </div>
          
                     <div class="form-group">
                        <label for="tipo">*Tipo Transaccion</label>
                        <select name="tipo" required  id="tipo" class="form-control">
                          <option value="">--Selecione--</option>
                          <option value="Credito">Credito (Adeudar)</option>
                          <option value="Debito">Debito (Abonar) </option>
                        </select>
                     </div>
          
                        <div class="form-group">
                            <label for="total">*Monto </label>
                            <input class="form-control"required type="number" step="any" placeholder="0.00" name="total" id="total">   
                        </div>
          
                        <div class="form-group">
                          <label for="total">*Descripcion </label>
                          <input class="form-control" required type="text" step="any" placeholder="Ingrese Descripcion" name="descripcion" id="descripcion">   
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



